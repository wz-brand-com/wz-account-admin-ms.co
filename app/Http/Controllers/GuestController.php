<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Organisation;
use Log;

class GuestController extends Controller
{
     // organization for dashboard page open

    //  public function organization_list_dashboard(){
    //     $all_getting_orgs = Organisation::orderBy('id', 'DESC')->take(8)->get();
    //     return view('organization-page',compact('all_getting_orgs'));
    // }

    public function service(){
        return view('services');
    }

    public function gallery(){
        return view('gallery');
    }
    
    public function about(){
        return view('about-us');
    }

    public function privacypolicy(){
        return view('privacy-policy');
    }

  

    
}
