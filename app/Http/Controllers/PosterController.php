<?php

namespace App\Http\Controllers;

use App\Poster;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PosterController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($competition_id)
    {
        // Get Today Date
        $dt = Carbon::now();
        $dt = $dt->toDateString();
        
        // Get The Posters Info According To Today Date
        $posters =  Poster::whereCompetitionId($competition_id)->leftJoin('partners', 'posters.partner_id', '=', 'partners.id')
                           ->where('start', '<=' , $dt)
                           ->Where('end', '>=', $dt)
                            ->join('posters_scales', function ($join) {
                                $join->on('posters.id', '=', 'posters_scales.poster_id')
                                    ->limit(1);
                            })
                            ->select('posters.*','commercial_name','posters_scales.*')
                            ->get();

        // Loop Through To Set Image Path And Type In English
        foreach($posters as $poster)
        {
            $poster->img_path = asset('storage/main/posters/'. $poster->image);

            $poster->type == "بـــــــانـــــــر" ? $poster->the_type = 'banner' : $poster->the_type = "screen";
        }


    
        return response()->json($posters, 200);
    }
}
