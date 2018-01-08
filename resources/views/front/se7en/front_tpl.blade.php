<!DOCTYPE html>
<html>
  
<head>
    <title>
      {{ $title }}
    </title>
    <link href="/se7en/stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/se7en/stylesheets/font-awesome.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/se7en/stylesheets/se7en-font.css" media="all" rel="stylesheet" type="text/css" />
    
    <link href="/se7en/stylesheets/select2.css" media="all" rel="stylesheet" type="text/css" />
    
    
    <link href="/se7en/stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/se7en/stylesheets/mystyle.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/se7en/stylesheets/color/green.css" media="all" rel="alternate stylesheet" title="green-theme" type="text/css" />
    <link href="/se7en/stylesheets/color/orange.css" media="all" rel="alternate stylesheet" title="orange-theme" type="text/css" />
    <link href="/se7en/stylesheets/color/magenta.css" media="all" rel="alternate stylesheet" title="magenta-theme" type="text/css" />
    <link href="/se7en/stylesheets/color/gray.css" media="all" rel="alternate stylesheet" title="gray-theme" type="text/css" />
    <!-- Material design风格浮动按钮特效 -->
    <link href="/mfb/mfb.min.css" media="all" rel="stylesheet" type="text/css" />

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    <div class="modal-shiftfix">
      <!-- Navigation -->
      <div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid top-bar">
          
          <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="logo" href="#">se7en</a>
          
        </div>
        <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav">
              @foreach($categories as $category)

                <li>
                  <a id="category_{{$category->id}}" href="{{ URL('/'.$front.'/volume?category_id='.$category->id )}}"><span aria-hidden="true" class="se7en-home"></span>{{ $category->name }}</a>
                </li>

              @endforeach
              
              
              
            </ul>
          </div>

        </div>
      </div>
      <!-- End Navigation -->
      <!-- Begin search  -->
      
      <div class="col-md-12" >
          <div class="input-group">
            <input class="form-control" type="text" id="search_item"><span class="input-group-btn"><button id="search_in_bible" class="btn btn-default" type="button" id="search_btn">搜索</button></span>
          </div>
        </div>

        <!-- <div class="col-md-12" >
          <div class="input-group">
            <input class="form-control" type="text" id="search_item">
              <div class="input-group-btn">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">搜索<span class="caret"></span></button>
                <ul class="dropdown-menu pull-right">
                  <li>
                    <a id="search_in_all" href="javascript:;">搜索全部</a>
                  </li>
                  <li>
                    <a id="search_in_bible" href="javascript:;">搜索圣经</a>
                  </li>
                  <li>
                    <a id="search_in_resource" href="javascript:;">搜索查经资料</a>
                  </li>
                  
                </ul>
              </div>
            
          </div>
        </div> -->
          
      <!-- End search  -->
      <div class="container-fluid main-content">

        @yield('content')
        
        
      </div>
    </div>

<ul id="menu" class="mfb-component--br mfb-zoomin" data-mfb-toggle="hover">
  <li class="mfb-component__wrap">
    <a href="#" class="mfb-component__button--main">
      <i class="mfb-component__main-icon--resting ion-plus-round"></i>
      <i class="mfb-component__main-icon--active ion-close-round"></i>
    </a>
    <ul class="mfb-component__list">
      <li>
        <a href="#" data-mfb-label="Child Button 1" class="mfb-component__button--child">
          <i class="mfb-component__child-icon ion-social-github">搜索</i>
        </a>
      </li>
      <li>
        <a href="#" data-mfb-label="Child Button 2" class="mfb-component__button--child">
          <i class="mfb-component__child-icon ion-social-octocat">首页</i>
        </a>
      </li>
      <li>
        <a href="#"
           data-mfb-label="Child Button 3" class="mfb-component__button--child">
          <i class="mfb-component__child-icon ion-social-twitter">下一章</i>
        </a>
      </li>
    </ul>
  </li>
</ul>

  </body>
  <script src="/se7en/javascripts/jquery-1.10.2.min.js" type="text/javascript"></script>
  <script src="/se7en/javascripts/jquery-ui.js" type="text/javascript"></script>
  <script src="/se7en/javascripts/bootstrap.min.js" type="text/javascript"></script>
  
  <script src="/se7en/javascripts/select2.js" type="text/javascript"></script>
  <script src="/se7en/javascripts/styleswitcher.js" type="text/javascript"></script>
  
  <script src="/se7en/javascripts/jquery.validate.js" type="text/javascript"></script>
  
  <script src="/se7en/javascripts/respond.js" type="text/javascript"></script>
  <script src="/se7en/javascripts/jquery.bootpag.min.js" type="text/javascript"></script>
  <script src="/layer/layer.js" type="text/javascript"></script>

  <script src="/se7en/javascripts/bootstrap-fileupload.js" type="text/javascript"></script>
  <script src="/se7en/javascripts/bootstrap-datepicker.js" type="text/javascript"></script>
  <script src="/se7en/javascripts/jquery.sparkline.min.js" type="text/javascript"></script>
  <script src="/se7en/javascripts/mymain.js" type="text/javascript"></script>
  <script src="/mfb/mfb.min.js" type="text/javascript"></script>
  <script>
  $(function () {
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      });
  });
  $('#search_in_bible').click(function(){
    search_item = $('#search_item').val();
    window.location="{{ URL('/'.$front.'/detail/search') }}?search_item="+search_item;
  });
  
  </script>
  @yield('scripts')
</html>