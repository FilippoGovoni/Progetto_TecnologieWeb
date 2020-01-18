<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $data = date('Y-m-d');
        $progetti=Project::all()->where('data_fine','<=',$data);
        foreach($progetti as $progetto){
            $progetto->update(['terminato'=>1]);
        }

        return view('home');
    }
}
