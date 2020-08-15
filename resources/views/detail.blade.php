@extends('layout')

@section('meta_title', '')

@section('meta_description', '')

@section('head')

@endsection

@section('header-class', 'extra-header')

@section('content')

  <nav class="secondary_nav sticky_horizontal_2- -extra-nav" id="results">
    <div class="container">
      <ul class="clearfix">
        <li><a href="#description" class="active">Описание</a></li>
        <li><a href="#reviews">Отзывы</a></li>
        <li><a href="#sidebar">Бронирование</a></li>
      </ul>
    </div>
  </nav>

  <div class="container margin_60_35">
    @include('partials.alerts')
    <div class="row">
      <div class="col-lg-8">
        <div id="carousel_in" class="owl-carousel owl-theme add_bottom_30">
          @if ($product->images != '')
            <?php $images = unserialize($product->images); ?>
            @foreach ($images as $k => $image)
              <div class="item"><img src="/img/products/{{ $product->path.'/'.$images[$k]['image'] }}" alt="{{ $product_lang->title }}"></div>
            @endforeach
          @endif
        </div>
        <section id="description">
          <div class="detail_title_1">
            <!-- <div class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></div> -->
            <h1>{{ $product_lang->title }}</h1>
            <p>{{ $product->area }}</p>
          </div>

          {!! $product_lang->description !!}
          <hr>
          @foreach($similar_products_lang as $similar_product_lang)
            <div class="room_type first">
              <div class="row">
                <div class="col-md-4">
                  <img src="/img/products/{{ $similar_product_lang->product->path.'/'.$similar_product_lang->product->image }}" class="img-fluid" alt="{{ $similar_product_lang->title }}">
                </div>
                <div class="col-md-8">
                  <h4><a href="/{{ $lang.'/'.Str::limit($similar_product_lang['slug'], 35).'/'.'p-'.$similar_product_lang->product->id }}">{{ $similar_product_lang->title }}</a></h4>
                  <ul class="hotel_facilities">
                    @foreach($product->options as $option)
                      <?php $titles = unserialize($option->title); ?>
                      <li>{{ $titles[$lang]['title'] }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          @endforeach
          <hr>
          <h3>Location</h3>
          <div id="map" class="map map_single add_bottom_45"></div>
        </section>

        <section id="reviews">
          <h2>Отзывы</h2>
          <p>Комментариев {{ $product->comments->count() }}</p>

          <div class="reviews-container">
            @unless ($product->comment === 'nobody')
              @foreach ($product->comments as $comment)
                <div class="review-box- clearfix">
                  <div class="rev-content">
                    <div class="rating">
                      <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="icon_star <?php if ($i <= $comment->stars) echo 'voted'; ?>"></i>
                      <?php endfor; ?>
                    </div>
                    <div class="rev-info">{{ $comment->name }} – </div>
                    <div class="rev-text">
                      <p>{{ $comment->comment }}</p>
                    </div>
                  </div>
                </div>
              @endforeach
            @endunless
          </div>
        </section>
        <hr>

        <div class="add-review">
          <h5>Форма для отзыва</h5>
          @if(Auth::check())
            <form action="/{{ $lang }}/review" method="post">
              {!! csrf_field() !!}
              <input name="id" type="hidden" value="{{ $product->id }}">
              <input name="type" type="hidden" value="ad">
              <div class="row">
                <div class="form-group col-md-6">
                  <label>Имя *</label>
                  <input type="text" name="name" id="name" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-6">
                  <label>Email *</label>
                  <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group col-md-6">
                  <label>Рейтинг </label>
                  <div class="custom-select-form">
                  <select name="stars" id="stars" class="wide">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5" selected>5</option>
                  </select>
                  </div>
                </div>
                <div class="form-group col-md-12">
                  <label>Ваш отзыв</label>
                  <textarea name="comment" id="comment" class="form-control" style="height:130px;"></textarea>
                </div>
                <div class="form-group col-md-12 add_top_20 add_bottom_30">
                  <input type="submit" value="Отправить" class="btn_1" id="submit-review">
                </div>
              </div>
            </form>
          @else
            <p><a href="/{{ $lang }}/cs-login-and-register">Зарегестрируйтесь</a> чтобы оставлять отзывы</p>
          @endif
        </div>
      </div>

      <aside class="col-lg-4" id="sidebar">
        <form action="/{{ $lang }}/send-app" method="post">
          {!! csrf_field() !!}
          <div class="box_detail booking">
            <div class="price">
              <span>Скидка</span>
              <div class="score">
                @foreach($product->options as $option)
                  <?php $titles = unserialize($option->title); ?>
                  <strong>{{ $titles[$lang]['title'] }}</strong>
                @endforeach
              </div>
            </div>
            <div class="form-group">
              <input class="form-control" type="text" name="name" minlength="2" maxlength="40" placeholder="Имя.." required>
            </div>
            <div class="form-group">
              <input class="form-control" type="tel" name="phone" minlength="2" maxlength="40" placeholder="Телефон.." required>
            </div>
            <div class="form-group" id="input-dates">
              <input class="form-control" type="text" name="time" placeholder="Дата..">
              <i class="icon_calendar"></i>
            </div>
            <button type="submit" class="add_top_30 btn_1 full-width purchase">Забронировать</button>
          </div>
        </form>
      </aside>
    </div>
  </div>
@endsection

@section('scripts')
  <!-- DATEPICKER  -->
  <script>
    $('input[name="dates"]').daterangepicker({
        "singleDatePicker": true,
        "parentEl": '#input-dates',
        "opens": "left"
    }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });
  </script>

  <!-- CAROUSEL -->
  <script>
    $('#carousel_in').owlCarousel({
      center: false,
      items:1,
      loop:false,
      margin:0
    });
  </script>

  <script type="text/javascript">

    <?php $product_lang = $product->products_lang->where('lang', $lang)->first(); ?>
    var product =
      <?php if(isset($product->latitude) && isset($product->longitude)): ?>
        {
          lat: <?= $product->latitude ?>,
          long: <?= $product->longitude ?>,
          text: '<a href="/<?= $lang.'/'.Str::limit($product_lang['slug'], 35).'/'.'p-'.$product->id ?>"><?= $product_lang['title'] ?></a>'
        };
      <?php else: ?>
        {};
      <?php endif; ?>

    ymaps.ready(init);

    function init() {
      var myPlacemark,
        location = ymaps.geolocation
        myMap = new ymaps.Map('map', {
          center: [43.23, 76.88],
          zoom: 14
        }, {
          searchControlProvider: 'yandex#search'
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
            // myMap.setCenter(result.geoObjects.position)
            myMap.setZoom(16)
          },
          function(err) {
            console.log('Ошибка: ' + err)
          }
        );

      pl = new ymaps.Placemark([product.lat, product.long]);
      pl.properties.set({
        balloonContentBody: product.text
      });
      myMap.geoObjects.add(pl);
      myMap.setCenter([product.lat, product.long])
    }
  </script>
@endsection
