<?php

namespace App\Http\Controllers\Admin;

use App\Partner;
use App\Upload\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $partners = Partner::all();
            return DataTables::of($partners)->addIndexColumn()
            ->addColumn('action', function($row){$btn = '<a href="'.route("partners.edit", [$row->id]).'" class="edit btn btn-primary btn-sm">تعديل</a>';return $btn;})
            ->addColumn('actionone', function($row){$btn = '<a href="'.route("partners.delete", [$row->id]).'" class="delete btn btn-danger btn-sm">حذف</a>';return $btn;})
            ->rawColumns(['action','actionone'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('admin.partners.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partners.add', ['countries' =>  DB::table('geo')->where('parent_id',1)->get() ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'required', 'commercial_name' => 'required', 'the_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000']);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['message' => 'من فضلك قم بمراجعة تلك الأخطاء', 'alert' => 'alert-danger']);
        }
        $request->merge(['image' => Upload::uploadImage($request->the_image, 'partners' , $request->first_name)]);
        Partner::create($request->except('_token','the_image'));
        return redirect()->route('partners.index')->with(['message' => 'تم الإضافة بنجاح', 'alert' => 'alert-success']);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        $city = DB::table('geo')->where('id', $partner->geo_id)->first();
        $city == null ? $country = null : $country = DB::table('geo')->where('id', $city->parent_id)->first()->id;
        return view('admin.partners.edit', ['partner' => $partner, 'countries' =>  DB::table('geo')->where('parent_id',1)->get(), 'theCity' => $city, 'theCountry' => $country ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        $validator = Validator::make($request->all(), ['name' => 'required', 'commercial_name' => 'required']);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['message' => 'من فضلك قم بمراجعة تلك الأخطاء', 'alert' => 'alert-danger']);
        }
        if($request->has('the_image')){
            $request->merge(['image' => Upload::uploadImage($request->the_image, 'partners' , $request->first_name)]);
        }
        $partner->update($request->except('the_image'));
        return redirect()->route('partners.index')->with(['message' => 'تم التعديل بنجاح', 'alert' => 'alert-success']);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route('partners.index')->with(['message' => 'تم الحذف بنجاح', 'alert' => 'alert-success']);
    }
}
