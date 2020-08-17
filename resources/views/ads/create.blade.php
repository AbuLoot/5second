@extends('layout')

@section('meta_title', '')

@section('meta_description', '')

@section('head')
  <script src='//cdn.tinymce.com/4.9/tinymce.min.js'></script>
  <script>
    tinymce.init({
      selector: 'textarea',
      height: 300,
      theme: 'modern',
      plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
      toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
      image_advtab: true,
      templates: [
        { title: 'Test template 1', content: 'Test 1' },
        { title: 'Test template 2', content: 'Test 2' }
      ],
      content_css: [
        // '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        // '//www.tinymce.com/css/codepen.min.css'
      ]
     });
  </script>
@endsection

@section('header-class', 'extra-header')

@section('content')

  <div class="sub_header_in sticky_header sub-header-indigo">
    <div class="container">
      <h1>Объявления</h1>
    </div>
  </div>

  <div class="container margin_80_55">
    <div class="row">
      <div class="col-lg-3">
        @include('account.menu')
      </div>
      <div class="col-lg-9">
        <form action="{{ route('my-ads.store', $lang) }}" method="post" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <div class="box_detail">
            <h2>Основная информация</h2>
            <div class="form-group">
              <label for="title">Название</label>
              <input type="text" class="form-control" id="title" name="title" minlength="5" value="{{ (old('title')) ? old('title') : '' }}" required>
            </div>
            <div class="form-group">
              <label for="description">Описание</label>
              <textarea class="form-control" name="description" rows="6" maxlength="2000">{{ (old('description')) ? old('description') : '' }}</textarea>
            </div>
            <div class="form-group">
              <label for="characteristic">Характеристика</label>
              <input type="text" class="form-control" id="characteristic" name="characteristic" minlength="2" value="{{ (old('characteristic')) ? old('characteristic') : '' }}">
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="price">Цена</label>

                  <div class="input-group mb-3">
                    <input type="text" class="form-control" id="price" name="price" maxlength="10" value="{{ (old('price')) ? old('price') : '' }}">
                    <div class="input-group-append">
                      <span class="input-group-text">{{ $currency->symbol }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="box_detail">
            <h2>Параметры</h2>
            <div class="row">
              <div class="col-md-6">
                <p><b>Категории</b></p>
                <div class="panel panel-default">
                  <div class="panel-body" style="max-height: 250px; overflow-y: auto;">
                    <?php $traverse = function ($nodes, $prefix = null) use (&$traverse) { ?>
                      <?php foreach ($nodes as $node) : ?>
                        <div class="radio">
                          <label>
                            <input type="radio" name="category_id" value="{{ $node->id }}"> {{ PHP_EOL.$prefix.' '.$node->title }}
                          </label>
                        </div>
                        <?php $traverse($node->children, $prefix.'___'); ?>
                      <?php endforeach; ?>
                    <?php }; ?>
                    <?php $traverse($categories); ?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <p><b>Опции</b></p>
                <div class="panel panel-default">
                  <div class="panel-body" style="max-height: 250px; overflow-y: auto;">
                    <?php $grouped = $options->groupBy('data'); ?>
                    @forelse ($grouped as $data => $group)
                      <?php $data = unserialize($data); ?>
                      <p><b>{{ $data[$lang]['data'] }}</b></p>
                      @foreach ($group as $option)
                        <?php $titles = unserialize($option->title); ?>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="options_id[]" value="{{ $option->id }}"> {{ $titles[$lang]['title'] }}
                          </label>
                        </div>
                      @endforeach
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="company_id">Мои компании</label>
                  <select id="company_id" name="company_id" class="form-control">
                    @foreach(\Auth::user()->companies as $company)
                      <option value="{{ $company->id }}">{{ $company->title }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="time">Время</label>
                  <input type="date" class="form-control" id="time" name="time" minlength="2" maxlength="80" value="{{ (old('time')) ? old('time') : '' }}">
                </div>
                <div class="form-group">
                  <label for="phones">Номера телефонов (чтобы разделить значения используйте знак /)</label>
                  <input type="text" class="form-control" id="phones" name="phones" value="{{ (old('phones')) ? old('phones') : NULL }}">
                </div>
                <div class="form-group">
                  <label for="area">Адрес</label>
                  <input id="address" class="form-control" name="area" id="area" minlength="2" placeholder="Например: Абая 32">
                  <!-- <span class="help-block">Например: Абая 32</span> -->
                </div>
              </div>
              <div class="col-md-12">
                <input type="text" id="latitude" name="latitude" value="" hidden>
                <input type="text" id="longitude" name="longitude" value="" hidden>
                <div id="map" class="map" style="width:100%; height:300px; margin-bottom: 30px"></div>
              </div>
              <div class="col-md-4 form-group">
                <label for="condition">Условие</label><br>
                <label class="radio-inline">
                  <input type="radio" name="condition" value="1" checked> Продажа
                </label>
                <label class="radio-inline">
                  <input type="radio" name="condition" value="2"> Аренда
                </label>
              </div>
            </div>
            <div class="row" id="gallery">
              <div class="col-md-12">
                <label>Галерея</label><br>
              </div>
              @for ($i = 0; $i < 6; $i++)
                <div class="col-md-4">
                  <input type="file" name="images[]" accept="image/*"><br><br>
                </div>
              @endfor
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                <p><b>Режимы</b></p>
                <div class="panel panel-default">
                  <div class="panel-body" style="max-height: 150px; overflow-y: auto;">
                    @foreach($modes as $mode)
                      <?php $titles = unserialize($mode->title); ?>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="modes_id[]" value="{{ $mode->id }}"> {{ $titles[$lang]['title'] }}
                        </label>
                      </div>
                    @endforeach
                  </div>
                </div>
                <div class="form-group">
                  <label for="status">Статус:</label>
                  <select id="status" name="status" class="form-control" required>
                    @foreach(trans('statuses.data') as $num => $status)
                      @if ($num == 1)
                        <option value="{{ $num}}" selected>{{ $status }}</option>
                      @else
                        <option value="{{ $num}}">{{ $status }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary">Создать</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <script type="text/javascript">
      ymaps.ready(init);

      function init() {

          let country = "Казахстан";
          let myGeocoder = ymaps.geocode($.trim(country));

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
                      myMap.setCenter(result.geoObjects.position)
                      myMap.setZoom(16)
                  },
                  function(err) {
                      console.log('Ошибка: ' + err)
                  }
              );
          $("#address").bind('keyup', function () {
              let address = $("#address").val();
              let myGeocoder = ymaps.geocode($.trim(country)+','+address);
              myGeocoder.then(
                  function (res) {
                      var coords = res.geoObjects.get(0).geometry.getCoordinates();
                      myGeocoder.then(
                          function (res) {
                              myMap.geoObjects.removeAll();
                              var placemark = new ymaps.Placemark(coords, {}, {
                                  draggable: true
                              });
                              myMap.geoObjects.add(placemark);
                              myMap.setCenter(coords, 16);
                              placemark.events.add("drag", function (event) {
                                  coords = placemark.geometry.getCoordinates();
                                  document.getElementById("latitude").value = coords[0];
                                  document.getElementById("longitude").value = coords[1];
                              });
                              document.getElementById("latitude").value = coords[0];
                              document.getElementById("longitude").value = coords[1];
                          }
                      );
                  });
          });
          // myMap.events.add('click', function (e) {
          //     var coords = e.get('coords');
          //     $("input#latitude").attr('value', coords[0])
          //     $("input#longitude").attr('value', coords[1])
          //     if (myPlacemark) {
          //         myPlacemark.geometry.setCoordinates(coords);
          //     } else {
          //         myPlacemark = createPlacemark(coords);
          //         myMap.geoObjects.add(myPlacemark);
          //         myPlacemark.events.add('dragend', function () {
          //             coords2 = myPlacemark.geometry.getCoordinates()
          //             $("input#latitude").attr('value', coords2[0])
          //             $("input#longitude").attr('value', coords2[1])
          //             getAddress(myPlacemark.geometry.getCoordinates());
          //         });
          //     }
          //     getAddress(coords);
          // });
          function createPlacemark(coords) {
              return new ymaps.Placemark(coords, {
                  iconCaption: 'поиск...'
              }, {
                  preset: 'islands#redDotIconWithCaption',
                  draggable: true
              });
          }

          function getAddress(coords) {
              myPlacemark.properties.set('iconCaption', 'поиск...');
              ymaps.geocode(coords).then(function (res) {
                  var firstGeoObject = res.geoObjects.get(0);

                  myPlacemark.properties
                      .set({
                          iconCaption: [
                              firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                              firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                          ].filter(Boolean).join(', '),
                          balloonContent: firstGeoObject.getAddressLine()
                      });
              });
          }
      }
  </script>
@endsection
