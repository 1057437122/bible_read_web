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
                  <a id="{{$category->id}}" href="{{ URL('/'.$front.'/volume?category_id='.$category->id )}}"><span aria-hidden="true" class="se7en-home"></span>{{ $category->name }}</a>
                </li>

              @endforeach
              
              
              
            </ul>
          </div>

        </div>
      </div>
      <!-- End Navigation -->
      <div class="container-fluid main-content">

        @yield('content')
        
        
      </div>
    </div>
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
  <script>
  $(function () {
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      });
  });
  
  </script>
  @yield('scripts')
</html>