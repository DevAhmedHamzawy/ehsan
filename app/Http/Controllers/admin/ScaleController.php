<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScaleController extends Controller
{
    // Get The Scales Depending On Poster Type
    public function index($id = null, $type ,$request)
    {
        if($type == 'بـــــــانـــــــر') { $type = 0; } else { $type = 1; }

        $scales_images = DB::table('scales')->where('type', $type)->get();
     
        if($request == 'edit') { 

            $images = DB::table('scales')->leftJoin('posters_scales', 'scales.id', '=', 'posters_scales.scale_id')->select('scales.*','measure','image')->where('posters_scales.poster_id', '=' , $id) ->get();
        
            foreach($images as $pic)
            {
                $pic->img_path = 'storage/main/posters/'. $pic->image;
            }

            return [$scales_images, $images];



        }

        return $scales_images;

    }
}
