<div class="tab_container">
        <div id="tab1" class="tab_content">
          @if(!empty($list))
          @foreach($list as $data)
        <a href="/news/detail/{{$data->id}}">
            <section class="box">
            @if(!empty($data->photo))  
            <img src="/images/news/{{$data->photo}}">
            @endif
              <div class="date">{{$data->dates}}</div>
              <h3 class="main_title">{{$data->title}}</h3>
              <p class="subtitle">{{$data->subTitle}}<br> more <i aria-hidden="true" class="fa fa-leaf"></i></p>
            </section></a>
          @endforeach
          @endif
        </div>

        <div id="tab2" class="tab_content">
          @if(!empty($list))
          @foreach($list as $data)
        <a href="/news/detail/{{$data->id}}">
            <section class="line">
        
              <div class="date">{{$data->dates}}</div>
              <h3 class="main_title">{{$data->title}}</h3>
              <p class="subtitle">{{$data->subTitle}}<br> more <i aria-hidden="true" class="fa fa-leaf"></i></p>
            </section></a>
          @endforeach
          @endif
        </div>

      </div>
      <script src="/js/front/product/jquery-2.1.3.min.js"></script>
      <script type="text/javascript">
      $(function() {
      var _showTab = 1;
      var $defaultLi = $('ul.tabs li').eq(_showTab).addClass('active');
      $($defaultLi.find('a').attr('href')).siblings().hide();
      $('ul.tabs li').click(function() {
      var $this = $(this),
      _clickTab = $this.find('a').attr('href');
      $this.addClass('active').siblings('.active').removeClass('active');
      $(_clickTab).stop(false, true).fadeIn().siblings().hide();
      return false;
      }).find('a').focus(function() {
      this.blur();
      });
      });
    </script>