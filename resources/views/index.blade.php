@extends('layout')

@section('meta_title', $page->meta_title ?? $page->title)

@section('meta_description', $page->meta_description ?? $page->title)

@section('head')
  <link href="/css/tables.css" rel="stylesheet">
@endsection

@section('content')
  <!-- BG -->
  @if(!empty($slide))
    <style>
      .hero_single.version_2 {
        height: 620px;
        background: #222 url(/img/slides/{{ $slide->image }}) center center no-repeat;
      }
    </style>
  @endif
  <section class="hero_single version_2">
    <div class="wrapper">
      <div class="container">
        <div class="col-lg-8 offset-lg-2">
          <h3>@if(!empty($slide)) {!! $slide->title !!} @endif</h3>
          <form method="get" action="/{{ $lang }}/search">
            <div class="row no-gutters custom-search-input-2">
              <div class="col-lg-7">
                <div class="form-group">
                  <input type="search" class="form-control" name="text" min="2" placeholder="Что вы ищите..." required>
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
              <div class="col-lg-2">
                <input type="submit" value="Поиск">
              </div>
            </div>
          </form>
        </div>
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
    @endforeach
  </div>

  <!-- Cards -->
  <div class="bg_color_1">
    <div class="container margin_80_55">
      <div class="main_title_2">
        <span><em></em></span>
        <h2>Скидочные карты</h2>
        <p>Приобретайте карты в магазинах Алматы</p>
      </div>
      <div class="row justify-content-center">
        @foreach($cards as $card)
          <div class="col-lg-4 col-md-6">
            <div class="box_cat_home">
              <h2 class="text-white">{{ $card->title }}</h2>
              <img src="/img/{{ $card->image }}" class="img-fluid">
              @if($card->slug == 'platinum')
                <h3 class="text-white">Для бизнес партнеров</h3>
              @else
                <h3 class="text-white">{{ $card->price }}₸/мес.</h3>
              @endif
              <ul>
                <li>Лимит ползователей: <strong class="text-white">{{ $card->user_number }}</strong></li>
              </ul>
              <ul>
                <li>Лимит автомобилей: <strong class="text-white">{{ $card->user_number }}</strong></li>
              </ul>
              <ul>
                <li>Лимит услуг: <strong class="text-white">{{ ($card->service_number == 0) ? 'Безлимитный' : $card->service_number }}</strong></li>
              </ul>
              @if($card->slug == 'platinum')
                <ul>
                  <li>Срок: <strong class="text-white">Безлимитный</strong></li>
                </ul>
              @else
                <ul>
                  <li>Срок: <strong class="text-white">30 дней</strong></li>
                </ul>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <!-- How It Works -->
  <?php $how_it_works = $section->firstWhere('slug', 'how-it-works'); ?>
  {!! $how_it_works->content !!}

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

@endsection

@section('scripts')
  <script src="/js/modernizr_tables.js"></script>
  <script src="/js/tables_func.js"></script>
@endsection