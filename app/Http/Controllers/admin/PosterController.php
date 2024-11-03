<?php

namespace App\Http\Controllers\Admin;

use App\Competition;
use App\Partner;
use App\Poster;
use App\Upload\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PosterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        if ($request->ajax()) {

            $posters =  Poster::leftJoin('partners', 'posters.partner_id', '=', 'partners.id')->select('posters.*','commercial_name')->get();
            return DataTables::of($posters)->addIndexColumn()->addColumn('action', function($row){$btn = '<a href="'.route("posters.edit", [$row->id]).'" class="edit btn btn-primary btn-sm">تعديل</a>';return $btn;})
            ->addColumn('actionone', function($row){$btn = '<a href="'.route("posters.delete", [$row->id]).'" class="delete btn btn-danger btn-sm">حذف</a>';return $btn;})
            ->rawColumns(['action','actionone'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('admin.posters.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posters.add', ['partners' => Partner::all(), 'competitions' => Competition::all(), 'countries' =>  DB::table('geo')->where('parent_id',1)->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['partner_id' => 'required|numeric', 'competition_id' => 'required|numeric', 'geo_id' => 'required|numeric', 'type' => 'required', 'name' => 'required' , 'description' => 'required' , 'start' => 'required|date' , 'end' => 'required|date']);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['message' => 'من فضلك قم بمراجعة تلك الأخطاء', 'alert' => 'alert-danger']);
        }

        // Check If Posts Are Existed In The Start And End Date
        $similar_Posters=Poster::where('type',$request->type)->where('competition_id',$request->competition_id)->get();
        $wrong_flag=0;
        foreach($similar_Posters as $poster){
            if(($request->start<$poster->start && $request->end<$poster->start)|| ($request->start>$poster->end && $request->end>$poster->end)){}
            else{
                   $wrong_flag=1; 
            }
        };
        if($wrong_flag)
        {
            return redirect()->route('posters.create')->with(['message' => 'الرجاء تغيير تاريخ البدء والإنتهاء ليكونوا غير متداخلين مع الإعلانات الأخرى', 'alert' => 'alert-danger']);
        }

        $poster = Poster::create($request->only('partner_id','competition_id','geo_id','name','type','description','start','end'));

        if($request->has('posters')){
            foreach($request->posters as $key=>$value){
                DB::table('posters_scales')->insert(['poster_id' => $poster->id, 'scale_id' => $key , 'image' => Upload::uploadImage($value[0], 'posters' , rand(0,5000000))]);
            }
        }

        return redirect()->route('posters.index')->with(['message' => 'تم الإضافة بنجاح', 'alert' => 'alert-success']); 
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Poster  $poster
     * @return \Illuminate\Http\Response
     */
    public function edit(Poster $poster)
    {

        $scales_images = DB::table('scales')->leftJoin('posters_scales', 'scales.id', '=', 'posters_scales.scale_id')->select('scales.*','measure','image')->where('posters_scales.poster_id', '=' , $poster->id) ->get();
        foreach($scales_images as $pic)
        {
            $pic->img_path = 'storage/main/posters/'. $pic->image;
        }
        $city = DB::table('geo')->where('id', $poster->geo_id)->first();
        $city == null ? $country = null : $country = DB::table('geo')->where('id', $city->parent_id)->first()->id;
        return view('admin.posters.edit', ['poster' => $poster, 'partners' => Partner::all(), 'competitions' => Competition::all(), 'scales_images' => $scales_images, 'countries' =>  DB::table('geo')->where('parent_id',1)->get(), 'theCity' => $city, 'theCountry' => $country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Poster  $poster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poster $poster)
    {
        // Check If Posts Are Existed Between start And End Date 
        $similar_Posters=Poster::where('type',$request->type)->where('competition_id',$request->competition_id)->where('id' , '!=' , $poster->id)->get();
        $wrong_flag=0;
        foreach($similar_Posters as $poster){
            if(($request->start<$poster->start && $request->end<$poster->start)|| ($request->start>$poster->end && $request->end>$poster->end)){}else{
                $wrong_flag=1; 
            }
        };
        if($wrong_flag)
        {
            return redirect()->back()->with(['message' => 'الرجاء تغيير تاريخ البدء والإنتهاء ليكونوا غير متداخلين مع الإعلانات الأخرى', 'alert' => 'alert-danger']);
        }
        if($request->type !== $poster->type){
            DB::table('posters_scales')->where('poster_id' , $poster->id)->delete();
        }
        $poster->update($request->only('partner_id','competition_id','geo_id','name','type','description','start','end'));
        if($request->has('posters')){
            foreach($request->posters as $key=>$value){
                DB::table('posters_scales')->where('scale_id' , $key)->delete();
                DB::table('posters_scales')->insert(['poster_id' => $poster->id, 'scale_id' => $key , 'image' => Upload::uploadImage($value[0], 'posters' , rand(0,5000000))]);
            }
        }
        return redirect()->route('posters.index')->with(['message' => 'تم التعديل بنجاح', 'alert' => 'alert-success']);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Poster  $poster
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poster $poster)
    {
        $poster->delete();
        DB::table('posters_scales')->where('poster_id' , $poster->id)->delete();
        return redirect()->route('posters.index')->with(['message' => 'تم الحذف بنجاح', 'alert' => 'alert-success']);
    }
}