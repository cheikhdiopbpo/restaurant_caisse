<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Authorizable;
use App\Categorie;
use App\Plat;
class HomeController extends Controller
{
   // use Authorizable;
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
        if(Auth::user()->roles->pluck('name')->first() ==="Admin"){
            return view('home');
        }
        else{
            $categories = Categorie::get();
            $result = Plat::with('categories')->get();
            return view('serveur.index',\compact('categories','result'));
        }
    }
}
