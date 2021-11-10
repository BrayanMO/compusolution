<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('users.index', compact ('users'));
    }

    public function create(){
        return view('users.create', compact ('users'));
    }
}
