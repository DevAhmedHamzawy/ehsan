<?php

namespace App\Http\Controllers\Admin;

use App\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ContributorController extends Controller
{
    // From Results Table Get All The Contributors
    public function index(Request $request, $competition_id)
    {
        $contributors = Result::whereCompetitionId($competition_id)->get();

        foreach ($contributors as $contributor) {
            $contributor->user->city = DB::table('geo')->where('id' , $contributor->user->geo_id)->first();
            $contributor->user->country = DB::table('geo')->where('id' , $contributor->user->city->id)->first();
        }

        if($contributors->isEmpty()) { return redirect()->back(); }

        if ($request->ajax()) {
            return DataTables::of($contributors)->addIndexColumn()->make(true);
        }
        

        return view('admin.contributors.index', compact('contributors'));
    }

}
