<?php

namespace OSD\Http\Controllers;

use OSD\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        if(Auth::user()->type_user->description=="Administrador"){

            return redirect('/dashboard');
        }


        if(Auth::user()->type_user->description=="Director"){

            return redirect('/interna');
        }


        return redirect('/logout');
        
    }
}
