<?php

namespace App\Http\Controllers\Admin;

use App\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CompetitionPosterController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if ($request->ajax()) {

            $posters =  Poster::where('competition_id', $id)->leftJoin('partners', 'posters.partner_id', '=', 'partners.id')->select('posters.*','commercial_name')->get();

            
            return DataTables::of($posters)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="'.route("posters.edit", [$row->id]).'" class="edit btn btn-primary btn-sm">تعديل</a>';
                $btn .= '<a href="'.route("posters.delete", [$row->id]).'" class="delete btn btn-danger btn-sm">حذف</a>';
                return $btn;
            })
            ->rawColumns(['action','actionone'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('admin.posters.competitions.index');
    }

}
