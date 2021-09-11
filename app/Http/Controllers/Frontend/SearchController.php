<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function Search(){
        if(isset($_REQUEST['search']) && !empty($_REQUEST('search'))){
           $search_product = $_REQUEST['search'];
        }
    }
}
