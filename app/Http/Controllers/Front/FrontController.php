<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends BaseController
{
    //
    public function __construct(){
    	parent::__construct();
    }
    public function index(){
    	echo 'this is Front index';
    	mylog('come to front page');
    	
    }
}
