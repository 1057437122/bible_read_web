<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Redirect;
class BaseController extends Controller
{
    //
    public $page;//分页时每页显示数量
    public $theme;
    public $category;
    public $front;

    public function __construct(){

    	//所有front中的类都继承这个方法，一些都有的变量都在这里进行设置
    	$this->page =  config('mysetting.page',15);
    	$this->theme = config('mysetting.theme','se7en');
    	$this->categories = DB::table('category')->get();
    	$this->title = config('mysetting.title','查经大全');
    	$this->front = config('mysetting.front_page','front');
    	$this->middleware(function ($request, $next) {
    		
            View::share('categories',$this->categories);
            View::share('title',$this->title);
            View::share('front',$this->front);
            
	        return $next($request);
	    });
        // DB::connection()->enableQueryLog();
        // DB::getQueryLog()
	    
    }
}
