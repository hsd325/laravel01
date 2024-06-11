<!DOCTYPE html>
<html lang="zh">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <meta name="description" content="雲端技術班第二個專案">
  <meta name="keywords" content="茶,好茶,喝好茶"><!--header的CSS-->
  <link href="/css/front/header/FontAwesome/font-awesome.css" rel="stylesheet">
  <link href="/css/front/header/bootstrap.min.css" rel="stylesheet">
  <link href="/css/front/header/animate.css" rel="stylesheet">
  <link href="/css/front/header/bootsnav.css" rel="stylesheet">
  <link href="/css/front/header/overwrite.css" rel="stylesheet">
  <link href="/css/front/header/style.css" rel="stylesheet">
  <link href="/css/front/header/color.css" rel="stylesheet">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries-->
  <style type="text/css">
    @import url(http://fonts.googleapis.com/earlyaccess/cwtexhei.css);
  </style>
  <!--if lt IE 9
    script(src='commons/header/js/html5shiv.min.js')
    script(src='commons/header/js/respond.min.js')
    
    --><!--GotoTop的CSS-->
  <link rel="stylesheet" type="text/css" href="/css/front/gototop/style.css"><!--footer的CSS-->
  <link rel="stylesheet" type="text/css" href="/css/front/footer/footer.css">
  <!-- 每頁title的CSS-->
  <link rel="stylesheet" type="text/css" href="/css/front/else/title.css">
  <!-- 首頁AD的CSS-->
  @if (Request::is("/"))
  <link href="/css/front/index/effects.min.css" rel="stylesheet">
  <link href="/css/front/index/index.css" rel="stylesheet">
  <!-- video的CSS-->
  <link href="/css/front/index/video.css" rel="stylesheet">
  @endif

  @if (Request::is("product/detail/*"))
  <link href="/css/front/product/jquery.bxslider.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="/css/front/product/web_product.css">
  <link rel="stylesheet" href="/css/front/product/product.css">
  <!-- 關於好茶 CSS-->
  <link rel="stylesheet" href="/css/front/product/product_int.css">
  <link rel="stylesheet" href="/css/front/product/video.css"><!--ScrollWatch滾動淡入-->
  @endif
  @if (Request::is("product/list/*"))
  <link href="/css/front/product/effects.min.css" rel="stylesheet">
  <link href="/css/front/product/style.css" rel="stylesheet">
  @endif
  @if(Request::is("product/*"))
  <style>
    .fade_in {
      opacity: 0;
      transition: opacity 2s;
    }

    .fade_in.scroll-watch-in-view {
      opacity: 1;
    }
  </style>
  @endif
</head>
<!-- oncontextmenu="window.event.returnValue=false" 為限制右鍵讓它無功能 -->

<body>
  <!-- Start Navigation-->
  <nav class="navbar navbar-default bootsnav">
    <!-- Start Top Search-->
    <div class="top-search">
      <div class="container">
        <div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span>
          <input type="text" placeholder="Search Products" class="form-control"><span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
        </div>
      </div>
    </div>
    <!-- End Top Search-->
    <div class="container">
      <!-- Start Atribute Navigation-->
      <div class="attr-nav lang_bar">
        <ul>
          <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
        </ul>
      </div>
      <!-- End Atribute Navigation-->
      <!-- Start Header Navigation-->
      <div class="navbar-header">
        <button type="button" data-toggle="collapse" data-target="#navbar-menu" class="navbar-toggle"><i class="fa fa-bars"></i></button><a href="index.html" class="navbar-brand"><img src="commons/header/img/brand/logo.svg" alt="" class="logo"></a>
      </div>
      <!-- End Header Navigation-->
      <!-- Collect the nav links, forms, and other content for toggling-->
      <div id="navbar-menu" class="collapse navbar-collapse">
        <ul data-in="fadeInDown" data-out="fadeOutUp" class="nav navbar-nav navbar-right">
          @foreach(session()->get("menu") as $data)
          @if($data->id == 3 || $data->id == 6)
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
              <span class="nav_img">
                <img src="/images/icon/icon_product.svg" alt="">
              </span>
              <p class="nav_p">{{ $data->app }}</p>
            </a>
            @if(!empty(session()->get("layer1")))
            <ul class="dropdown-menu">
              @foreach(session()->get("layer1") as $layer1)
              <li><a href="/product/list/{{ $data->id }}/{{ $layer1->id }}">{{ $layer1->layer1_name }}</a></li>
              @endforeach
            </ul>
            @endif
          </li>
          @else
          <li>
            <a href="/{{ $data->url }}/{{ $data->id }}">
              <span class="nav_img">
                @if($data->url == "news")
                <img src="/images/icon/news_icon.svg" alt="{{ $data->app }}">
                @else
                <img src="/images/icon/icon_{{ $data->url }}.svg" alt="{{ $data->app }}">
                @endif
              </span>
              <p class="nav_p">{{ $data->app }}</p>
            </a>
          </li>
          @endif
          @endforeach
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
              <p class="nav_p">語系</p>
            </a>
            <ul class="dropdown-menu">
              @foreach(session()->get("lanList") as $data)
              <li><a href="javascript:getLan('{{ $data->id }}')">{{ $data->title }}</a></li>
              @endforeach
            </ul>
          </li>
        </ul>

      </div>
      <!-- /.navbar-collapse-->
    </div>
  </nav>
  <!-- End Navigation-->

  @yield("content")

  <div class="footer">
    <div class="icon">
      <ul>
        <li><a href="#"><img src="/images/icon/icon_fb.svg"></a></li>
        <li><a href="#"><img src="/images/icon/icon_line.svg"></a></li>
        <li><a href="#"><img src="/images/icon/img/icon_ig.svg"></a></li>
        <li><a href="#"><img src="/images/icon/icon_twitter.svg"></a></li>
      </ul>
    </div>
    <div class="nav">
      <ul>
        <li><a href="/about">關於</a></li>
        <li><a href="/news">最新消息</a></li>
        <li><a href="/product">好茶</a></li>
        <li><a href="/knowl">品茶知識</a></li>
        <li><a href="/contact">聯絡我們</a></li>
      </ul>
    </div>
    <div class="logo"><a href="index.html"><img src="commons/footer/img/logo.svg" alt=""></a></div>
    <div class="info">
      <div class="line"><a href="" target="_blank">A . </a><br> <a href="tel:+">T . +</a><br> F . <br></div>
    </div>
    <div class="copyright"><a href="copyright.html">智慧財產權聲明</a> © 2017 . All Rights Reserved </div>
  </div>
  <!-- Scroll to Top button selector-->
  <div><a class="to-top"><img src="commons/gototop/img/gototop.svg" alt=""></a></div>
  <!--header的JS-->
  <script>
    window.jQuery || document.write('<script src="/js/header/jquery-1.11.0.min.js "><\/script>')
  </script>
  <script src="/js/header/bootstrap.min.js "></script>
  <script src="/js/header/bootsnav_2.js "></script>
  <!--GotoTop的JS-->
  <script src="/js/gototop/jquery.toTop.min.js"></script>
  <script>
    jQuery(function($) {
      // Plugin activation (basic)
      // $('.to-top').toTop();
      // Plugin activation with options
      $('.to-top').toTop({
        //options with default values
        autohide: true, //boolean 'true' or 'false'
        offset: 250, //numeric value (as pixels) for scrolling length from top to hide automatically
        speed: 650, //numeric value (as mili-seconds) for duration
        right: 20, //numeric value (as pixels) for position from right
        bottom: 60 //numeric value (as pixels) for position from bottom
      });
    });
  </script>

  <script src="/js/front/product/jquery-2.1.3.min.js"></script>
  @if(Request::is("product", "product/*"))
  <!-- ScrollWatch滾動淡入-->
  <script src="/js/front/about/ScrollWatch-1.2.0.js"></script>
  <script>
    (function() {
      var swInstance = new ScrollWatch({});
    })();
  </script>
  <!-- product_photo_JS-->
  <script src="/js/front/product/jquery.bxslider.js"></script>
  <script type="text/javascript" src="/js/front/product/jquery.elevateZoom-3.0.8.min.js"></script>
  <script src="/js/front/product/web_product.js"></script>
  @endif

  <script>
    function getLan(id) {
      console.log(id);
      $.ajax({
        url: "/lan/" + id,
        type: "get",
        success: function(msg) {
          console.log("1");
          // location.reload();
          location.href = "/";
        }
      });
    }
  </script>
</body>

</html>