<?php

namespace App\Http\Controllers\Payment;

use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Modules\Plan\Entities\Plan;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;
use App\Notifications\MembershipUpgradeNotification;

class StripeController extends Controller
{
    use PaymentTrait;

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        try {
            Stripe::setApiKey(array_key_exists('STRIPE_SECRET', $_SERVER) ? $_SERVER['STRIPE_SECRET'] : env('STRIPE_SECRET'));

            $plan = Plan::findOrFail($request->plan_id);
            $this->userPlanInfoUpdate($plan);
            $this->createTransaction($request->stripeToken, 'Stripe', $request->amount, $request->plan_id);
            $user = auth('customer')->user();
            $user->notify(new MembershipUpgradeNotification($user, $plan->label));
            storePlanInformation();

            session()->flash('success', 'Payment Successfully');
            return redirect()->route('frontend.plans-billing');


        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripeApiPost(Request $request)
    {
        try {
            Stripe::setApiKey(array_key_exists('STRIPE_SECRET', $_SERVER) ? $_SERVER['STRIPE_SECRET'] : env('STRIPE_SECRET'));

            $plan = Plan::findOrFail($request->plan_id);
            $this->userPlanInfoUpdate($plan);
            $this->createTransaction($request->stripeToken, 'Stripe', $request->amount, $request->plan_id);
            $user = auth('customer')->user();
            $user->notify(new MembershipUpgradeNotification($user, $plan->label));
            storePlanInformation();

            return Response::json([
//                'data'=>$data,
                'success'=>'Payment Successfully'
            ],200);
        } catch (\Exception $ex) {
            return response($ex->getMessage(),400);
        }
    }
}
