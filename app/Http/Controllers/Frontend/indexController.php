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
        $meta_title= "EX-Commerce The online shop";
        $meta_description =" Lorem quamconsectetur, natus consequuntur quaerat iusto ab fugit sit maxime commodi alias atque!";
        $meta_keywords = "E-commerce, Product, Best , Offer, New, Latest, Now, Lather, Electric, Payment, COD,";
        return view('frontend.pages.index')->with(compact('featuredArrayChunk','latestProduct','pageName','meta_title', 'meta_description', 'meta_keywords'));
    }
}
