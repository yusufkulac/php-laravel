<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;


class BlogController extends Controller
{
    
    //site bloglar sayfası --------------------------------------------------------------------
    public function bloglar(){
       
        $bloglar = Blog::where("aktif", 1)->orderBy("id", "desc")->paginate(9);                             

        return view("Site.blog.list", compact("bloglar"));
    }
    // ./site bloglar sayfası -----------------------------------------------------------------


    //site blog detay sayfası -----------------------------------------------------------------
    public function blogDetay($id, $slug){
       
        $blog = Blog::with("resimler")->where("id", intval($id))->first();  

        //son 4 blod                           
        $bloglar = Blog::where("id", "!=", intval($id))->orderBy("id", "desc")->limit(4)->get();

        return view("Site.blog.detay", compact("blog", "bloglar"));
    }
    // ./site blog detay sayfası ---------------------------------------------------------------

    

    


}// ***************************************************************************************
