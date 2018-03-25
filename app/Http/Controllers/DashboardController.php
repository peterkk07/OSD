<?php

namespace OSD\Http\Controllers;

use OSD\Http\Requests;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
        return \View::make('home');
    }

    public function showCreateUserForm(){
        return \View::make('admin.createUser');
    }

    public function addUser(){

    }
}
