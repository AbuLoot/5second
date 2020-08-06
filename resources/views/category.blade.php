@extends('layout')

@section('meta_title', $category->meta_title ?? $category->title)

@section('meta_description', $category->meta_description ?? $category->title)

@section('head')

@endsection

@section('header-class', 'extra-header')

@section('content')
  <div id="results">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-10">
          <h4>{{ $category->title }}: Объектов <strong>{{ $category->products->count() }}</strong></h4>
        </div>
        <div class="col-lg-8 col-md-8 col-2">
          <a href="#0" class="side_panel btn_search_mobile"></a> <!-- /open search panel -->
          <form method="get" action="/{{ $lang }}/search">
            <div class="row no-gutters custom-search-input-2 inner">
              <div class="col-lg-4">
                <div class="form-group">
                  <input type="search" class="form-control" name="text" placeholder="Что вы ищите...">
                  <i class="icon_search"></i>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Где">
                  <i class="icon_pin_alt"></i>
                </div>
              </div>
              <div class="col-lg-3">
                <select class="wide">
                  <option>Все категории</option>
                  <option>Shops</option>
                  <option>Hotels</option>
                  <option>Restaurants</option>
                  <option>Bars</option>
                  <option>Events</option>
                  <option>Fitness</option>
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
        </li> -->
        <li><a class="btn_filt" data-toggle="collapse" href="#filters" aria-expanded="false" aria-controls="filters" data-text-swap="Скрыть" data-text-original="Фильтры">Фильтры</a></li>
        <li>
          <div class="layout_view">
            <a href="#0" class="active"><i class="icon-th"></i></a>
            <a href="listing-2.html"><i class="icon-th-list"></i></a>
            <a href="list-map.html"><i class="icon-map"></i></a>
          </div>
        </li>
        <li>
          <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">На карте</a>
        </li>
      </ul>
    </div>
  </div>

  <!-- Filter list -->
  <div class="collapse" id="filters">
    <div class="container margin_30_5">
      <div class="row">
        <form action="/catalog/{{ $category->slug }}" method="get" id="filter">
          {{ csrf_field() }}
          <?php $options_id = session('options'); ?>
          @foreach ($grouped as $data => $group)
            <div class="col-md-4">
              <?php $data = unserialize($data); ?>
              <h6>{{ $data[$lang]['data'] }}</h6>
              <ul>
                @foreach ($group as $option)
                  <?php $titles = unserialize($option->title); ?>
                  <li>
                    <label class="container_check">{{ $titles[$lang]['title'] }}
                      <input type="checkbox" id="o{{ $option->id }}" name="options_id[]" value="{{ $option->id }}" @if(isset($options_id) AND in_array($option->id, $options_id)) checked @endif>
                      <span class="checkmark"></span>
                    </label>
                  </li>
                @endforeach
              </ul>
            </div>
          @endforeach
        </form>
      </div>
    </div>
  </div>

  <!-- Map -->
  <div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
  </div>

  <div class="container margin_60_35">

    <div id="products" class="row">
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
                <small class="mb-0">{{ $product->area }}</small>
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

    <!-- <p class="text-center"><a href="#0" class="btn_1 rounded add_top_30">Load more</a></p> -->
    </div>
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
      @foreach($products as $product)
      <?php $product_lang = $product->products_lang->where('lang', $lang)->first(); ?>
      @if(isset($product->latitude) && isset($product->longitude))
        {
        lat: {{ $product->latitude }},
        long: {{ $product->longitude }},
        text: '<a href="/{{ $lang.'/'.Str::limit($product_lang['slug'], 35).'/'.'p-'.$product->id }}">{{ $product_lang['title'] }}</a>'
        },
      @endif
      @endforeach
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
            myMap.setZoom(16)
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
