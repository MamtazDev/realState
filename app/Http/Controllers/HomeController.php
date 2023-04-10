<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(){
        $testmonials = Testimonial::all();
        $all_news = News::with('relationwithNewsCategory')->take(3)->get();
        return view('frontend.home', compact('testmonials', 'all_news'));
    }
     

}
