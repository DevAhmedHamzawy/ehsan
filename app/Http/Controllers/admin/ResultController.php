<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Result;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ResultController extends Controller
{
    public function index(Request $request, $competition_id)
    {
        // Get Competition Results
        $results = Result::whereCompetitionId($competition_id)->get();

        // If Empty :- Redirect To Competitions Page
        if($results->isEmpty()) { return redirect()->back(); }

        // Get The Records In Datatable
        if ($request->ajax()) {
            return DataTables::of($results)->addIndexColumn()->make(true);
        }

        // Goto Results Page
        return view('admin.results.index', compact('results'));
    }
}
