<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index(){
        // $featuredItemCount= Product::where('is_featured','Yes')->where('status',1)->count();
        $pageName="index";
        $featuredItems= Product::where('is_featured','Yes')->where('status',1)->get()->toArray();
        $featuredArrayChunk=array_chunk($featuredItems,4);
        $latestProduct=Product::where('status',1)->limit(6)->latest()->get();
        return view('frontend.pages.index')->with(compact('featuredArrayChunk','latestProduct','pageName'));
    }
}
