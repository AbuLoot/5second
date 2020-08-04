@extends('joystick-admin.layout')
@section('head')

    <script src="https://api-maps.yandex.ru/2.1/?apikey=f8a0ddb3-4528-4fd3-a6b1-db34eddbcd7a&lang=ru_RU" type="text/javascript">
    </script>
@endsection
@section('content')
    <h2 class="page-header">Редактирование</h2>

    @include('joystick-admin.partials.alerts')

    <div class="row">
        <div class="col-md-6">
            <ul class="nav nav-tabs">
                @foreach ($languages as $language)
                    <li role="presentation" @if ($language->slug == $product_lang->lang) class="active" @endif><a href="/{{ $language->slug }}/admin/products/{{ $product->id }}/edit">{{ $language->title }}</a></li>
                @endforeach
                <li role="presentation"><a href="/{{ $lang }}/admin/products/{{ $product->id }}/comments">Коментарии</a></li>
            </ul>
        </div>
        <div class="col-md-6">
            <p class="text-right">
                <a href="/{{ $lang }}/admin/products" class="btn btn-primary btn-sm">Назад</a>
            </p>
        </div>
    </div><br>

    <form action="/{{ $lang }}/admin/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        {!! csrf_field() !!}

        <div class="panel panel-default">
            <div class="panel-heading">Основная информация</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="title">Название</label>
                    <input type="text" class="form-control" id="title" name="title" minlength="5" maxlength="80" value="{{ (old('title')) ? old('title') : $product_lang->title }}" required>
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" minlength="2" maxlength="80" value="{{ (old('slug')) ? old('slug') : $product_lang->slug }}">
                </div>
                <div class="form-group">
                    <label for="title_extra">Дополнитеьное название</label>
                    <input type="text" class="form-control" id="title_extra" name="title_extra" minlength="5" value="{{ (old('title_extra')) ? old('title_extra') : $product_lang->title_extra }}">
                </div>
                <div class="form-group">
                    <label for="meta_title">Мета заголовок</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title" maxlength="255" value="{{ (old('meta_title')) ? old('meta_title') : $product_lang->meta_title }}">
                </div>
                <div class="form-group">
                    <label for="meta_description">Мета описание</label>
                    <input type="text" class="form-control" id="meta_description" name="meta_description" maxlength="255" value="{{ (old('meta_description')) ? old('meta_description') : $product_lang->meta_description }}">
                </div>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea class="form-control" name="description" rows="6" maxlength="2000">{{ (old('description')) ? old('description') : $product_lang->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="characteristic">Характеристика</label>
                    <input type="text" class="form-control" id="characteristic" name="characteristic" minlength="2" maxlength="80" value="{{ (old('characteristic')) ? old('characteristic') : $product_lang->characteristic }}">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Цена за кв. м.</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="price" name="price" maxlength="10" value="{{ (old('price')) ? old('price') : $product_lang->price }}">
                                <div class="input-group-addon">{{ $currency->symbol }}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lang">Язык</label>
                            <select id="lang" name="lang" class="form-control" required>
                                @foreach($languages as $language)
                                    @if ($language->slug == $product_lang->lang)
                                        <option value="{{ $language->slug }}" selected>{{ $language->title }}</option>
                                    @else
                                        <option value="{{ $language->slug }}">{{ $language->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Параметры</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="barcode">Артикул</label>
                        <input type="text" class="form-control" id="barcode" name="barcode" value="{{ (old('barcode')) ? old('barcode') : $product->barcode }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="company_id">Компания</label>
                        <select id="company_id" name="company_id" class="form-control">
                            <option value=""></option>
                            @foreach($companies as $company)
                                @if ($company->id == $product->company_id)
                                    <option value="{{ $company->id }}" selected>{{ $company->title }}</option>
                                @else
                                    <option value="{{ $company->id }}">{{ $company->title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <p><b>Категории</b></p>
                        <div class="panel panel-default">
                            <div class="panel-body" style="max-height: 250px; overflow-y: auto;">
                                <?php $traverse = function ($nodes, $prefix = null) use (&$traverse, $product) { ?>
                                <?php foreach ($nodes as $node) : ?>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="category_id" value="{{ $node->id }}" <?php if ($product->category_id == $node->id) echo "checked"; ?>> {{ PHP_EOL.$prefix.' '.$node->title }}
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
                                                <input type="checkbox" name="options_id[]" value="{{ $option->id }}" @if ($product->options->contains($option->id)) checked @endif> {{ $titles[$lang]['title'] }}
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
                            <label for="time">Время</label>
                            <input type="date" class="form-control" id="time" name="time" maxlength="10" value="{{ (old('time')) ? old('time') : $product->time }}">
                        </div>
                        <div class="form-group">
                            <label for="phones">Номера телефонов (чтобы разделить значения используйте знак /)</label>
                            <input type="text" class="form-control" id="phones" name="phones" value="{{ (old('phones')) ? old('phones') : $product->phones }}">
                        </div>
                        <div class="form-group">
                            <label for="area">Адрес</label>
                            <input class="form-control" name="area" id="area" minlength="2" placeholder="Например: Абая 32" value="{{ (old('area')) ? old('area') : $product->area }}">
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                            <!-- <span class="help-block">Например: Абая 32</span> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="count">Количество</label>
                        <input type="number" class="form-control" id="count" name="count" minlength="5" maxlength="80" value="{{ (old('count')) ? old('count') : $product->count }}">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="condition">Условие</label><br>
                        <label class="radio-inline">
                            <input type="radio" name="condition" value="1" @if ($product->condition == '1') checked @endif> Продажа
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="condition" value="2" @if ($product->condition == '2') checked @endif> Аренда
                        </label>
                    </div>
                </div>
                <div class="row" id="gallery">
                    <div class="col-md-12">
                        <label>Галерея</label><br>
                    </div>
                    <?php $images = ($product->images == true) ? unserialize($product->images) : []; ?>
                    <?php $key_last = array_key_last($images); ?>
                    @for ($i = 0; $i <= (($key_last >= 6) ? $key_last : 5); $i++)
                        @if(array_key_exists($i, $images))
                            <div class="col-md-4 col-xs-12 fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width:100%;height:200px;">
                                    <img src="/img/products/{{ $product->path.'/'.$images[$i]['present_image'] }}">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="width:100%;height:200px;" data-trigger="fileinput"></div>
                                <div>
                  <span class="btn btn-default btn-sm btn-file">
                    <span class="fileinput-new"><i class="glyphicon glyphicon-folder-open"></i>&nbsp; Изменить</span>
                    <span class="fileinput-exists"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;</span>
                    <input type="file" name="images[]" accept="image/*">
                  </span>
                                    <label>
                                        <input type="checkbox" name="remove_images[]" value="{{ $i }}"> Удалить
                                    </label>
                                    <a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput"><i class="glyphicon glyphicon-trash"></i> Удалить</a>
                                </div>
                            </div>
                        @else
                            <div class="col-md-4 col-xs-12 fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" style="width:100%;height:200px;" data-trigger="fileinput"></div>
                                <div>
                  <span class="btn btn-default btn-sm btn-file">
                    <span class="fileinput-new"><i class="glyphicon glyphicon-folder-open"></i>&nbsp; Выбрать</span>
                    <span class="fileinput-exists"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;</span>
                    <input type="file" name="images[]" accept="image/*">
                  </span>
                                    <a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput"><i class="glyphicon glyphicon-trash"></i> Удалить</a>
                                </div>
                            </div>
                        @endif
                    @endfor
                </div>
                <div>
                    <button type="button" class="btn btn-success" onclick="addFileinput(this);">Добавить загрузчик</button>
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
                                            <input type="checkbox" name="modes_id[]" value="{{ $mode->id }}" <?php if ($product->modes->contains($mode->id)) echo "checked"; ?>> {{ $titles[$lang]['title'] }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sort_id">Порядковый номер</label>
                            <input type="text" class="form-control" id="sort_id" name="sort_id" maxlength="5" value="{{ (old('sort_id')) ? old('sort_id') : $product->sort_id }}">
                        </div>
                        <div class="form-group">
                            <label for="status">Статус</label>
                            <select id="status" name="status" class="form-control" required>
                                @foreach(trans('statuses.data') as $num => $status)
                                    @if ($num == $product->status)
                                        <option value="{{ $num}}" selected>{{ $status }}</option>
                                    @else
                                        <option value="{{ $num}}">{{ $status }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <input type="text" id="latitude" name="latitude" value="" hidden>
                    <input type="text" id="longitude" name="longitude" value="" hidden>
                    <div class="col-md-12">
                        <div id="map" class="map" style="width: 100%; height:400px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Обновить</button>
        </div>
    </form>
@endsection

@section('head')
    <link href="/joystick/css/jasny-bootstrap.min.css" rel="stylesheet">
    <script src='//cdn.tinymce.com/4.9/tinymce.min.js'></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 400,
            theme: 'modern',
            plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
            toolbar1: 'code undo redo | formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
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

@section('scripts')
    <script src="/joystick/js/jasny-bootstrap.js"></script>
    <script>
        function addFileinput(i) {
            var fileinput =
                '<div class="col-md-4 col-xs-12 fileinput fileinput-new" data-provides="fileinput">' +
                '<div class="fileinput-preview thumbnail" style="width:100%;height:200px;" data-trigger="fileinput"></div>' +
                '<div>' +
                '<span class="btn btn-default btn-sm btn-file">' +
                '<span class="fileinput-new"><i class="glyphicon glyphicon-folder-open"></i>&nbsp; Выбрать</span>' +
                '<span class="fileinput-exists"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;</span>' +
                '<input type="file" name="images[]" accept="image/*">' +
                '</span>' +
                '<a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput"><i class="glyphicon glyphicon-trash"></i> Удалить</a>' +
                '</div>' +
                '</div>';

            $('#gallery').append(fileinput);
        }
    </script>
    <script type="text/javascript">
        ymaps.ready(init);

        function init() {

            var location = ymaps.geolocation
            myMap = new ymaps.Map('map', {
                center: [43.23, 76.88],
                zoom: 14
            }, {
                searchControlProvider: 'yandex#search'
            });

            @if (isset($product->latitude) && isset($product->longitude))
                coords = [{{$product->latitude}}, {{$product->longitude}}]
                var myPlacemark = createPlacemark(coords)
                $("input#latitude").attr('value', coords[0])
                $("input#longitude").attr('value', coords[1])
                myMap.geoObjects.add(myPlacemark);

                myPlacemark.events.add('dragend', function () {
                    coords2 = myPlacemark.geometry.getCoordinates()
                    $("input#latitude").attr('value', coords2[0])
                    $("input#longitude").attr('value', coords2[1])
                    getAddress(myPlacemark.geometry.getCoordinates());
                });
            @else
                var myPlacemark;

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
            @endif
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

            function createPlacemark(coords) {
                return new ymaps.Placemark(coords, {}, {
                    draggable: true
                });
            }
        }



    </script>
@endsection
