<?php

namespace App\Http\Controllers\Admin;

use App\Spinwheel;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SpinwheelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get Top 10 User Points At All
        $results = User::where('points', '!=' , '-1')->orderByDesc('points')->take(10)->get();

        // Return Records In Datatable
        if ($request->ajax()) {
            return DataTables::of($results)->addIndexColumn()->make(true);
        }

        // Go To Spin Wheel Page
        return view('admin.spinwheels.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get Top 10 User Points At All
        $results = User::where('points', '!=' , '-1')->orderByDesc('points')->take(10)->get();

        $randomResults = $results->random(2);

        // randomize then insert into spin wheel finally make user points to zero
        foreach($randomResults as $result){
            Spinwheel::create(['user_id' => $result->id]);
            User::whereId($result->id)->update(['points' => 0]);
        }

        // return random results
        return redirect('getspinwheels')->with(['message' => 'تم اجراء القرعة بنجاح', 'alert' => 'alert-success']);
    }


    public function get(Request $request)
    {
        // Get Top 10 User Points At All
        $spinwheels = Spinwheel::with('user')->orderByDesc('created_at')->get();

        // Return Records In Datatable
        if ($request->ajax()) {
            return DataTables::of($spinwheels)
            ->addIndexColumn()
            ->editColumn('created_at', function ($user) 
            {
                //change over here
                return date('m/d/Y', strtotime($user->created_at) );
            })->make(true);
        }
 
        // Go To Spin Wheel Page
        return view('admin.spinwheels.show', compact('spinwheels'));
    }
}
