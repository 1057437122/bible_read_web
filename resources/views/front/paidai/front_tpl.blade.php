<?xml version="1.0" encoding="UTF-8"?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<meta xmlns="http://www.w3.org/1999/xhtml" name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />



<meta xmlns="http://www.w3.org/1999/xhtml" name="MobileOptimized" content="240" />

<meta name="apple-itunes-app" content="app-id=716585349, app-argument=http://appdp:275">

<meta name="MobileOptimized" content="470" />

<title>{{ $title }}</title>
<link type="text/css" rel="stylesheet" href="/paidai/css/gbolbal_20141010.css" />
<link type="text/css" rel="stylesheet" href="/paidai/css/bootstrap.min.css" />
<link rel="stylesheet" href="/paidai/css/bbslist.css?v=2013013007" type="text/css" />
<script language="javascript">



if (top.location != location) top.location.href = location.href;



</script>

</head>

<body>	

	<p id="top" class="top1 clearfix">

		<a class="logo" href="default.htm"><img src="images/shouwei/new_logo.gif?v=1" height="33" width="118"></a>                       

		<a href="login.html" title="我的">

			<span class="touxiang"><img  src="images/shouwei/jobs/person.gif" /></span>		

		</a>

	</p>

                

                

	<div id="active_br"></div>        

	<style>



		#link img{ max-width: 100%;}

		#oTop img{ max-width: 100%;}

		#oTop{width:100%; position:relative;}

		#oLink1{ position:absolute; top:0px; left:0px; width:14%; height:35%;}

		#oLink2{ position:absolute; top:0px; right:0px; width:86%; height:100%;}

		.nav a{width:20%;}

		.nav a.last{border-right:none;}



	</style>

    <script language="javascript">

        

	var ua = navigator.userAgent,

	isIphone = /iPhone/.test(ua),

	isIpad = /iPad/.test(ua),

	isSafari = /Version/i.test(ua),

    version = /OS[7-9](_\d+){2}/i.test(ua),<!--/OS [7-9]_\d[_\d]/i.test(ua)-->

	isAndroid = /Android/i.test(ua) || /Linux/.test(ua);

	isMobile = /AppleWebKit.*Mobile.*/.test(ua); //是否是移动终端

	



	if(isIphone && !isIpad && !isSafari && version){

			var oLink = document.createElement('a');				

			oLink.id='link';

			oLink.style.width="100%";

			oLink.href='http://www.smallseashell.com/';

			oLink.innerHTML = '<img width="640" src="images/shouwei/WAP-IOS.jpg">';

			var logo = document.getElementById('top');

			document.body.insertBefore(oLink,logo);

	}

	if(isMobile && isAndroid && !isIpad){

		var oTop = document.createElement('div');

		oTop.id = 'oTop';

		active_br.innerHTML = '<a href="http://www.smallseashell.com/"><img style="width:100%; max-width:100%" src="images/shouwei/WAP-Android-new.jpg"></a><a href="javascript:;" id="oLink1"></a>';

		document.getElementById('oLink1').onclick = function(){

			active_br.style.display = 'none';

		}

	}



    </script>

        

    <div class="nav">

		<a class="black bold c96 font14 fl nav_list " href="{{ URL('/'.$front.'/category/1' )}}" title="旧约">xx</a>

		@foreach($categories as $category)

			<a class=" c96 font14 fl nav_list "  href="{{ URL('/'.$front.'/volume?category_id='.$category->id )}}" title="{{ $category->name }}">{{ $category->name }}</a>

		@endforeach

		

		<p class="clear"></p>

	</div>


	<div id="main">
		@yield('content')
		
			<div id="more" class="mt10">
	        <a class="more fl font14 c64"  href="index.html?act=morelist&page=2">更&nbsp;多</a>
	        <p class="clear"></p>
	    </div>
		<div class="clear"></div>
	</div>
	<!--尾部-->
	<div id="foot">
		

	<p class="clear"></p>
	</div>

</body>
<script src="/paidai/js/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="/paidai/js/jquery.bootpag.min.js" type="text/javascript"></script>
@yield('scripts')
</html>