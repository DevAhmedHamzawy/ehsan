<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Upload\Upload;
use App\User;
use DataTables;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Role :- 0 is Admin
        // Role :- 2 Is Questions Editor
        if ($request->ajax()) {

            $users = User::whereRole(0)->orWhere('role', 2)->get();
    
            return DataTables::of($users)->addIndexColumn()
            ->addColumn('action', function($row){ $btn = '<a href="'.route("admins.edit", [$row->id]).'" class="edit btn btn-warning btn-sm">نعديل</a>';return $btn;})
            ->addColumn('actionone', function($row){$btn = '<a href="'.route("admins.delete", [$row->id]).'"  class="delete btn btn-danger btn-sm">حذف</a>';return $btn;})
            ->rawColumns(['action','actionone'])
            ->addIndexColumn()
            ->make(true);
    
        }
    
        return view('admin.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$request->merge(['image' => Upload::uploadImage($request->the_image, 'users' , rand(0,999999))]);
        $request->merge(['password' => bcrypt($request->password)]);
        User::create($request->except('_token','the_image'));
        return redirect()->route('admins.index')->with(['message' => 'تم الإضافة بنجاح', 'alert' => 'alert-success']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.admins.edit', ['user' => $user]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->merge(['password' => bcrypt($request->password)]); 
        $user->update($request->all());
        return redirect()->route('admins.index')->with(['message' => 'تم التعديل بنجاح', 'alert' => 'alert-success']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admins.index')->with(['message' => 'تم الحذف بنجاح', 'alert' => 'alert-success']);
    }
}
