@extends('layout')

@section('meta_title', 'Поиск объявлении')

@section('meta_description', 'Поиск объявлении')

@section('head')

@endsection

@section('header-class', 'extra-header')

@section('content')
  <div id="results">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-10">
          <h4>Объектов: <strong>{{ $products->count() }}</strong></h4>
        </div>
        <div class="col-lg-8 col-md-8 col-2">
          <a href="#0" class="side_panel btn_search_mobile"></a> <!-- /open search panel -->
          <form method="get" action="/{{ $lang }}/search">
            <div class="row no-gutters custom-search-input-2 inner">
              <div class="col-lg-8">
                <div class="form-group">
                  <input type="search" class="form-control" name="text" placeholder="Что вы ищите...">
                  <i class="icon_search"></i>
                </div>
              </div>
              <div class="col-lg-3">
                <select name="region_id" class="wide">
                  @foreach($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->title }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-lg-1">
                <input type="submit">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="filters_listing sticky_horizontal-">
    <div class="container">
      <ul class="clearfix">
        <!-- <li>
          <div class="switch-field" id="actions">
            @foreach(trans('data.sort_by') as $key => $value)
              <input type="radio" id="{{ $key }}" name="listing_filter" value="{{ $key }}" @if($key == session('action')) checked @endif>
              <label for="{{ $key }}">{{ $value }}</label>
            @endforeach
          </div>
        </li>
        <li>
          <div class="layout_view">
            <a href="#0" class="active"><i class="icon-th"></i></a>
            <a href="listing-2.html"><i class="icon-th-list"></i></a>
            <a href="list-map.html"><i class="icon-map"></i></a>
          </div>
        </li> -->
        <li><a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Скрыть карту" data-text-original="Открыть карту">На карте</a></li>
      </ul>
    </div>
  </div>

  <div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
  </div>

  <div class="container margin_60_35">
    <h3>Объявления по запросу: <b>{{ $text }}</b></h3><br>

    <div class="row">
      @foreach($products as $product)
        <?php $product_lang = $product->products_lang->where('lang', $lang)->first(); ?>
        <div class="col-xl-4 col-lg-6 col-md-6">
          <div class="strip grid">
            <figure>
              <a href="/{{ $lang.'/'.Str::limit($product_lang['slug'], 35).'/'.'p-'.$product->id }}"><img src="/img/products/{{ $product->path.'/'.$product->image }}" class="img-fluid" alt="{{ $product_lang['title'] }}">
                <div class="read_more"><span>Подробнее</span></div>
              </a>
              <!-- <small>Restaurant</small> -->
            </figure>
            <div class="wrapper">
              <h6><a href="/{{ $lang.'/'.Str::limit($product_lang['slug'], 35).'/'.'p-'.$product->id }}">{{ $product_lang['title'] }}</a></h6>
              @if(!empty($product->area))
                <small class="mb-0">{{ $product->region->title }}, {{ $product->area }}</small>
              @endif
            </div>
            <ul>
              <li>
                <div class="score">
                  @foreach($product->options as $option)
                    <?php $titles = unserialize($option->title); ?>
                    <strong>{{ $titles[$lang]['title'] }}</strong>
                  @endforeach
                </div>
              </li>
            </ul>
          </div>
        </div>
      @endforeach
    </div>

    <div class="text-center">
      {{ $products->links() }}
    </div>
  </div>
  
  <!-- Sign In Popup -->
  <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
      <h3>Sign In</h3>
    </div>
    <form>
      <div class="sign-in-wrapper">
        <a href="#0" class="social_bt facebook">Login with Facebook</a>
        <a href="#0" class="social_bt google">Login with Google</a>
        <div class="divider"><span>Or</span></div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" name="email" id="email">
          <i class="icon_mail_alt"></i>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password" id="password" value="">
          <i class="icon_lock_alt"></i>
        </div>
        <div class="clearfix add_bottom_15">
          <div class="checkboxes float-left">
            <label class="container_check">Remember me
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
          </div>
          <div class="float-right mt-1"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
        </div>
        <div class="text-center"><input type="submit" value="Log In" class="btn_1 full-width"></div>
        <div class="text-center">
          Don’t have an account? <a href="register.html">Sign up</a>
        </div>
        <div id="forgot_pw">
          <div class="form-group">
            <label>Please confirm login email below</label>
            <input type="email" class="form-control" name="email_forgot" id="email_forgot">
            <i class="icon_mail_alt"></i>
          </div>
          <p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
          <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
        </div>
      </div>
    </form>
    <!--form -->
  </div>

@endsection

@section('scripts')
  <script>
    // Actions for products
    $('#actions').change(function() {
      var action = $(this).val();
      var page = $(location).attr('href').split('ru')[1];
      var slug = page.split('?')[0];

      $.ajax({
        type: "get",
        url: '/ru'.page,
        dataType: "json",
        data: {
          "action": action
        },
        success: function(data) {
          $('#products').html(data);
          // location.reload();
        }
      });
    });

    // Filter products
    $('#filter').on('click', 'input', function(e) {
      var optionsId = new Array();

      $('input[name="options_id[]"]:checked').each(function() {
        optionsId.push($(this).val());
      });

      var page = $(location).attr('href').split('ru')[1];
      var slug = page.split('?')[0];

      $.ajax({
        type: 'get',
        url: '/ru' + slug,
        dataType: 'json',
        data: {
          'options_id': optionsId,
        },
        success: function(data) {
          $('#products').html(data);
        }
      });
    });
  </script>

  <script type="text/javascript">
    var products = [
      <?php foreach($products as $product): ?>
        <?php $product_lang = $product->products_lang->where('lang', $lang)->first(); ?>
        <?php if(isset($product->latitude) && isset($product->longitude)): ?>
          {
            lat: <?= $product->latitude ?>,
            long: <?= $product->longitude ?>,
            text: '<a href="/<?= $lang.'/'.Str::limit($product_lang['slug'], 35).'/p-'.$product->id ?>"><?= $product_lang['title'] ?></a>'
          },
        <?php endif; ?>
      <?php endforeach; ?>
    ];

    ymaps.ready(init);

    function init() {

      var myPlacemark,
        location = ymaps.geolocation
        myMap = new ymaps.Map('map', {
        center: [43.23, 76.88],
        zoom: 14
      });

      location.get()
        .then(
          function(result) {
            var userAddress = result.geoObjects.get(0).properties.get('text');
            var userCoodinates = result.geoObjects.get(0).geometry.getCoordinates();
            result.geoObjects.get(0).properties.set({
              balloonContentBody: 'Адрес: ' + userAddress +
                '<br/>Координаты:' + userCoodinates
            });
            myMap.geoObjects.add(result.geoObjects)
            myMap.setCenter(result.geoObjects.position)
            myMap.setZoom(13)
          },
          function(err) {
            console.log('Ошибка: ' + err)
          }
        );
      for (var i = 0; i < products.length; ++i) {
        pl = new ymaps.Placemark([products[i].lat, products[i].long]);
        pl.properties.set({
          balloonContentBody: products[i].text
        });
        myMap.geoObjects.add(pl);
      }
    }
  </script>
@endsection