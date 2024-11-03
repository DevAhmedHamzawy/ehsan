<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Competition;
use App\Http\Controllers\Controller;
use App\Partner;
use App\Question;
use App\Upload\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $competitions = Competition::all();

            return DataTables::of($competitions)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="'.route("competitions.edit", [$row->id]).'" class="edit btn btn-primary btn-sm"><i class="material-icons icon">create</i></a>';
                $btn .= '<a href="'.route("competitions.delete", [$row->id]).'" class="delete btn btn-danger btn-sm"><i class="material-icons icon">delete</i></a>';
                $btn .= '<a href="'.route("competitionposters.index", [$row->id]).'" class="edit btn btn-warning btn-sm"><i class="material-icons icon">visibility</i></a>';
                $btn .= '<a href="'.route("results.index", [$row->id]).'" class="edit btn btn-primary btn-sm"><i class="material-icons icon">radio_button_checked</i></a>';
                $btn .= '<a href="'.route("contributors.index", [$row->id]).'" class="edit btn btn-primary btn-sm"><i class="material-icons icon">person</i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->editColumn('created_at', function ($user) {  return date('m/d/Y', strtotime($user->created_at) ); })
            ->addIndexColumn()
            ->make(true);

        }

        return view('admin.competitions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.competitions.add', ['partners' => Partner::all(), 'categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'required', 'description' => 'required', 'the_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000']);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['message' => 'من فضلك قم بمراجعة تلك الأخطاء', 'alert' => 'alert-danger']);
        }
        $request->merge(['image' => Upload::uploadImage($request->the_image, 'competitions' , $request->name)]);
        Competition::create($request->except('_token','the_image','questions','answers','question0','question1','question2','question3','question4','question5','question6','question7','question8','question9'));
        return redirect()->route('competitions.index')->with(['message' => 'تم الإضافة بنجاح', 'alert' => 'alert-success']);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function edit(Competition $competition)
    {
        return view('admin.competitions.edit', ['competition' => $competition, 'partners' => Partner::all(), 'categories' => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competition $competition)
    {

        if(auth()->user()->role == 0){
            $validator = Validator::make($request->all(), ['name' => 'required', 'description' => 'required']);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->with(['message' => 'من فضلك قم بمراجعة تلك الأخطاء', 'alert' => 'alert-danger']);
            }
            if($request->has('the_image')){
                $request->merge(['image' => Upload::uploadImage($request->the_image, 'competitions' , $request->name)]);
            }
        }
        $competition->update($request->except('the_image','questions','answers','question0','question1','question2','question3','question4','question5','question6','question7','question8','question9'));
        return redirect()->route('competitions.index')->with(['message' => 'تم التعديل بنجاح', 'alert' => 'alert-success']);  
    }

    public function search(Request $request)
    {
        $competitions =  Competition::whereBetween('created_at', [$request->from, $request->to])->get();
        $from = $request->from; 
        $to = $request->to;

        return view('admin.competitions.search', compact('competitions','from','to'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        $competition->delete();
        return redirect()->route('competitions.index')->with(['message' => 'تم الحذف بنجاح', 'alert' => 'alert-success']);
    }
}
