<?php

namespace Modules\OurTeam\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\OurTeam\Entities\OurTeam;


use Modules\OurTeam\Actions\CreateOurTeam;
use Modules\OurTeam\Actions\DeleteOurTeam;
use Modules\OurTeam\Actions\UpdateOurTeam;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\OurTeam\Http\Requests\OurTeamFormRequest;

class OurTeamController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
//        if (!userCan('ourteam.view')) {
//            return abort(403);
//        }
//        if (!enableModule('ourteam')) {
//            abort(404);
//        }
<<<<<<< HEAD
        $ourteams = OurTeam::orderby('order','ASC')->get();
=======
        $ourteams = OurTeam::latest()->get();
>>>>>>> 22b55fde6224d191d258811364a6227ea57cd3df
        return view('ourteam::index', compact('ourteams'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
//        if (!userCan('ourteam.create')) {
//            return abort(403);
//        }
//        if (!enableModule('ourteam')) {
//            abort(404);
//        }
        return view('ourteam::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(OurTeamFormRequest $request)
    {
//        if (!userCan('ourteam.create')) {
//            return abort(403);
//        }
        $ourteam = CreateOurTeam::create($request);

        if ($ourteam) {
            flashSuccess('OurTeam Added Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(OurTeam $ourteam)
    {
//        if (!userCan('ourteam.update')) {
//            return abort(403);
//        }
//        if (!enableModule('ourteam')) {
//            abort(404);
//        }
        return view('ourteam::edit', compact('ourteam'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(OurTeamFormRequest $request, OurTeam $ourteam)
    {
//        if (!userCan('ourteam.update')) {
//            return abort(403);
//        }
        $ourteam = UpdateOurTeam::update($request, $ourteam);

        if ($ourteam) {
            flashSuccess('OurTeam Updated Successfully');
            return redirect(route('module.ourteam.index'));
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(OurTeam $ourteam)
    {
//        if (!userCan('ourteam.delete')) {
//            return abort(403);
//        }

        $ourteam = DeleteOurTeam::delete($ourteam);

        if ($ourteam) {
            flashSuccess('OurTeam Deleted Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }
}
