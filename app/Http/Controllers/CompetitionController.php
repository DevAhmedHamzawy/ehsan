<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Http\Resources\CompetitionResource;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return CompetitionResource::collection(Competition::whereCategoryId($id)->get());
    }
}
