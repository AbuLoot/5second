@extends('layout')

@section('meta_title', $page->meta_title ?? $page->title)

@section('meta_description', $page->meta_description ?? $page->title)

@section('head')

@endsection

@section('logo', 'logo-white-200x51.png')

@section('content')
  <!-- BG -->
  <section class="hero_single version_2">
    <div class="wrapper">
      <div class="container">
        <h3>Найди скидку от 10% до 90% <br> на все виды автоуслуг</h3>
        <!-- <p>Здесь собраны все виды автоуслуг что делает данную отрасль автоматизированной и удобной для потребителей и наших партнеров.</p> -->
        <form method="get" action="/{{ $lang }}/search">
          <div class="row no-gutters custom-search-input-2">
            <div class="col-lg-4">
              <div class="form-group">
                <input type="search" name="text" class="form-control typeahead-goods" data-provide="typeahead" placeholder="Что вы ищите...">
                <i class="icon_search"></i>
              </div>
            </div>
            <div class="col-lg-3">
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
            <div class="col-lg-2">
              <input type="submit" value="Поиск">
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- Categories Ads -->
  <div class="container margin_60_35">
    @foreach($relevant_categories as $relevant_category)
      <div class="main_title_3">
        <span></span>
        <h2>{{ $relevant_category->title }}</h2>
        <p>{{ $relevant_category->title_extra }}</p>
        <a href="/{{ $lang.'/'.$relevant_category->slug.'/c-'.$relevant_category->id }}">Все</a>
      </div>
      <div class="row add_bottom_30">
        @foreach($relevant_category->products->where('status', 1)->take(3) as $product)
          <?php $product_lang = $product->products_lang->where('lang', $lang)->first(); ?>
          <div class="col-md-4">
            <div class="strip grid">
              <figure>
                <a href="/{{ $lang.'/'.Str::limit($product_lang['slug'], 35).'/'.'p-'.$product->id }}"><img src="/img/products/{{ $product->path.'/'.$product->image }}" class="img-fluid" alt="{{ $product_lang['title'] }}">
                  <div class="read_more"><span>Подробнее</span></div>
                </a>
                <!-- <small>Restaurant</small> -->
              </figure>
              <div class="wrapper">
                <h6><a href="/{{ $lang.'/'.Str::limit($product_lang['slug'], 35).'/'.'p-'.$product->id }}">{{ $product_lang['title'] }}</a></h6>
                <small class="mb-0">{{ $product->area }}</small>
              </div>
              <ul>
                <li>От {{ $product_lang['price'] }}〒</li>
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
    @endforeach
  </div>

  <!-- Categories Items -->
  <div class="bg_color_1">
    <div class="container margin_80_55">
      <div class="main_title_2">
        <span><em></em></span>
        <h2>Популярные Категории</h2>
      </div>
      <div class="row">
        @foreach($categories->take(6) as $category)
          <div class="col-lg-4 col-sm-6">
            <a href="/{{ $lang.'/'.$category->slug.'/c-'.$category->id }}" class="grid_item">
              <figure>
                <img src="/file-manager/{{ $category->image }}" alt="{{ $category->title }}">
                <div class="info">
                  <small>Объектов {{ $category->products->count() }}</small>
                  <h3>{{ $category->title }}</h3>
                </div>
              </figure>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <!-- How It Works -->
  <div class="call_section">
    <div class="wrapper">
      <div class="container margin_80_55">
        <div class="main_title_2">
          <span><em></em></span>
          <h2>Как это работает?</h2>
          <!-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p> -->
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="box_how">
              <i class="pe-7s-search"></i>
              <h3>Регистрируйтесь!</h3>
              <p>Зарегистрируетесь на нашем сайте.</p>
              <span></span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="box_how">
              <i class="pe-7s-info"></i>
              <h3>Активируйтесь!</h3>
              <p>Пополните личный счет и Активируйте карту на месяц</p>
              <span></span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="box_how">
              <i class="pe-7s-like2"></i>
              <h3>Пользуетесь!</h3>
              <p>Пользуетесь всеми услугами со скидкой в течении месяца до конца активации</p>
            </div>
          </div>
        </div>
        <p class="text-center add_top_30 wow bounceIn" data-wow-delay="0.5s"><a href="account.html" class="btn_1 rounded">Зарегестрироваться</a></p>
      </div>
      <canvas id="hero-canvas" width="1920" height="1080"></canvas>
    </div>
  </div>

@endsection

@section('scripts')

@endsection