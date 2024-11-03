<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return QuestionResource::collection(Question::whereCategoryId($id)->has('answers')->inRandomOrder()->take(10)->get());
    }
}
