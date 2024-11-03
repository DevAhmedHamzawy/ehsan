<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartnerFormRequest;
use App\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Partner::all(), 200);
    }

}
