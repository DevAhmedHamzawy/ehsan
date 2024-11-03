<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Upload\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $categories = Category::all();

            return DataTables::of($categories)->addIndexColumn()
            ->addColumn('action', function($row){$btn = '<a href="'.route("categories.edit", [$row->id]).'" class="edit btn btn-primary btn-sm">تعديل</a>';return $btn;})
            ->addColumn('actionone', function($row){$btn = '<a href="'.route("categories.delete", [$row->id]).'" class="delete btn btn-danger btn-sm">حذف</a>';return $btn;})
            ->rawColumns(['action','actionone'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'required']);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['message' => 'من فضلك قم بمراجعة تلك الأخطاء', 'alert' => 'alert-danger']);
        }

        $request->merge(['image' => Upload::uploadImage($request->the_image, 'categories' , $request->name)]);
        Category::create($request->except('_token','the_image'));
        return redirect()->route('categories.index')->with(['message' => 'تم الإضافة بنجاح', 'alert' => 'alert-success']);  
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        return view('admin.categories.edit', ['category' => $category]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        $validator = Validator::make($request->all(), ['name' => 'required']);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['message' => 'من فضلك قم بمراجعة تلك الأخطاء', 'alert' => 'alert-danger']);
        }

        if($request->has('the_image')){
            $request->merge(['image' => Upload::uploadImage($request->the_image, 'categories' , $request->name)]);
        }
        $category->update($request->except('the_image'));
        return redirect()->route('categories.index')->with(['message' => 'تم التعديل بنجاح', 'alert' => 'alert-success']);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with(['message' => 'تم الحذف بنجاح', 'alert' => 'alert-success']);
    }
}
