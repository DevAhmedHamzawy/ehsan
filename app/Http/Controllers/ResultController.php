<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Result;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function store($competition_id, $right_answers, $wrong_answers)
    {
        // Get The Competition
        $competition = Competition::findOrFail($competition_id);

        // if The User Didn't Complete The Competition
        if($right_answers+$wrong_answers < 10) { $points = -1; }

        else {

            // if The Right Answers didn't reach the min right answers
            if($competition->min_ans > $right_answers) {
                $right_answers = 0; $wrong_answers = 10;
                $points = 0;
            }else{

                // Divide Points By The right Answers
                $points = $competition->points/$right_answers;
            }
        
        }

        // Insert Result Record
        $result = Result::create(['user_id' => auth()->user()->id , 'competition_id' => $competition_id , 'right_answers' => $right_answers , 'wrong_answers' => $wrong_answers, 'points' => $points]);

        // Increase User Points
        $user = User::findOrFail(auth()->user()->id);
        if($user->points != null){
            $user->points = $user->points + $points;
        }else{
            $user->points = $points;
        }
        $user->update();

        // return result
        return response()->json($result, 200); 
    }

    public function topPoints()
    {
        // Get Top 10 User Points At All
        $results = User::where('points', '!=' , '-1')->orderByDesc('points')->take(10)->get();


        // return result
        return response()->json($results, 200); 

    }

}
