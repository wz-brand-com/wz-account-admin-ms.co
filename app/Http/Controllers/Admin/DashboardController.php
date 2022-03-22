<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Seoassets;
use App\Taskmanager;
use App\Seokeyword;
use App\Project;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
}
