<?php

namespace App\Http\Controllers;


class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('contents.dashboard.index');
    }
}
