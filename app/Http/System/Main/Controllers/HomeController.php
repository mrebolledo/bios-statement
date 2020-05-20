<?php

namespace App\Http\System\Main\Controllers;

use App\App\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('system.main.home',['title' => 'Home']);
    }
}
