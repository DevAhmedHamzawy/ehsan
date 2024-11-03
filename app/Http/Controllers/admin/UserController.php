<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Role (1) :- Regular User
        if ($request->ajax()) {
            $users = User::whereRole(1)->get();
            return DataTables::of($users)->addIndexColumn()
            ->addColumn('action', function($row){$btn = '<a href="'.route("users.edit", [$row->id]).'" class="edit btn btn-warning btn-sm">نعديل</a>';return $btn;})
            ->addColumn('actionone', function($row){$btn = '<a href="'.route("users.delete", [$row->id]).'"  class="delete btn btn-danger btn-sm">حذف</a>';return $btn;})
            ->rawColumns(['action','actionone'])
            ->addIndexColumn()
            ->make(true);
            }
    
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.add',  ['countries' =>  DB::table('geo')->where('parent_id',1)->get() ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['password' => bcrypt('password')]);
        User::create($request->all());
        return redirect()->route('users.index')->with(['message' => 'تم الإضافة بنجاح', 'alert' => 'alert-success']);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $city = DB::table('geo')->where('id', $user->geo_id)->first();
        $city == null ? $country = null : $country = DB::table('geo')->where('id', $city->parent_id)->first()->id;
        return view('admin.users.edit', ['user' => $user,  'countries' =>  DB::table('geo')->where('parent_id',1)->get(), 'theCity' => $city, 'theCountry' => $country ]);
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
       $request->merge(['password' => bcrypt('password')]);
       $user->update($request->all());
       return redirect()->route('users.index')->with(['message' => 'تم التعديل بنجاح', 'alert' => 'alert-success']);
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
        return redirect()->route('users.index')->with(['message' => 'تم الحذف بنجاح', 'alert' => 'alert-success']);
    }
}
