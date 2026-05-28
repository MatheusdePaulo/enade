<?php

namespace App\Http\Controllers;

class ForumController extends Controller
{
    public function index()
    {
        return view('forum.index');
    }
}
