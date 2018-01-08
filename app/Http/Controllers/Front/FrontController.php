<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class FrontController extends BaseController
{
    //
    public function __construct(){
    	parent::__construct();
    }
    public function index(){

    	$permanent = 1;

    	header('Location: ' . URL('/'.$this->front.'/volume'), true, $permanent ? 301 : 302);

    	exit();
    	
    }
}
