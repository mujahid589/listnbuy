<?php

namespace App\Http\Controllers\APIs;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Actions\File\FileDelete;
use App\Actions\File\FileUpload;
use App\Actions\Frontend\ProfileUpdate;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'socialLogin', 'forgot_password']]);
    }

    // function for registering the users
    public function register(Request $request)
    {
        $request->validate([
            'name' => "required",
            'username' => "required|unique:customers,username",
            'email' => "required|email|unique:customers,email",
            'password' => "required|confirmed|min:8|max:50",
        ]);

        $created = Customer::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($created) {
            return $this->login();
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


    // for profile Update
    public function profileUpdate(Request $request)
    {
        $customer = auth()->user();
        if($request->hasFile('image')) {
            $image = $request->image;
            if ($image) {
                $customerImage = file_exists($customer->image);

                if ($customerImage && $customer->image != 'backend/image/default.png') {
                    FileDelete::delete($customer->image);
                }

                $url = FileUpload::upload($image, 'customer');
                $customer->update(['image' => $url]);
            }
        }

        $request->validate([
            'name' => "required",
            'email' => "required|email|unique:customers,email,{$customer->id}",
            'phone' => "sometimes|nullable|unique:customers,phone,{$customer->id}",
            'web' => "sometimes|nullable|url|unique:customers,web,{$customer->id}",
        ]);

        try {
            $customer = ProfileUpdate::update($request, $customer);

            if ($customer) {
                return response()->json([
                    'status' => true,
                    'data' => [
                        'message' => 'Profile updated successfully.'
                    ]
                ]);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    // for social media login
    public function socialLogin(Request $request)
    {
        $request->validate([
            'provider' => 'required|in:google,facebook,twitter,linkedin,github,gitlab,bitbucket',
            'provider_id' => 'required'
        ]);

        $provider = $request->provider;

        $socialiteUserId = $request->provider_id;
        $socialiteUserName = $request->name;
        $socialiteUseremail = $request->email;
        $user = Customer::where([
            'provider' => $provider,
            'provider_id' =>  $socialiteUserId,
        ])->first();

        if (!$user) {

            $validator = Validator::make(
                ['email' => $socialiteUseremail],
                ['email' => ['unique:customers,email']],
                ['email.unique' => 'Couldn\'t login. Maybe you used a different login method?'],
            );

            if ($validator->fails()) {
                return response()->json($validator->messages(), 400);
            }


            $usernameExists = Customer::where('username', Str::slug($socialiteUserName))->count();

            if ($usernameExists) {
                $username = Str::slug($socialiteUserName) . '_' . Str::random(5);
            } else {
                $username = Str::slug($socialiteUserName);
            }


            $user = Customer::create([
                'name' => $socialiteUserName,
                'email' => $socialiteUseremail,
                'username' => $username,
                'provider' => $provider,
                'provider_id' =>  $socialiteUserId,
            ]);
        }

        if (! $token = Auth::guard('api')->login($user)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
        // storePlanInformation();
        // loggedinNotification();
        // resetSessionWishlist();
    }


    // for reset password
    function resetPassword(Request $request) {
        $input = $request->all();
        $userid = Auth::guard('api')->user()->id;
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            try {
                if ((Hash::check(request('old_password'), Auth::guard('api')->user()->password)) == false) {
                    return response()->json(["status" => 400, "message" => "Check your old password."], 400);
                } else if ((Hash::check(request('new_password'), Auth::guard('api')->user()->password)) == true) {
                    return response()->json(["status" => 400, "message" => "Please enter a password which is not similar then current password."], 400);
                } else {
                    Customer::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    return response()->json(["status" => 200, "message" => "Password updated successfully."], 400);
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                return response()->json([
                    "status" => 400, "message" => $msg, "data" => array()
                ], 400);
            }
        }
    }

    // for forgot password email
    public function forgot_password(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            try {
                $status = Password::sendResetLink(
                    $request->only('email')
                );

                return $status === Password::RESET_LINK_SENT
                            ? response()->json(['status' => __($status)])
                            : response()->json(['email' => __($status)]);
            } catch (\Swift_TransportException $ex) {
                return response()->json(["status" => 400, "message" => $ex->getMessage()], 400);
            } catch (\Exception $ex) {
                return response()->json(["status" => 400, "message" => $ex->getMessage()], 400);
            }
        }
    }
}
