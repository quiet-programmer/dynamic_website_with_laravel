<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function index() {
        return "<center>Index working</center>";
    }

    public function about() {
        return "<center>About working</center>";
    }
}
