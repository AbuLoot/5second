@extends('layout')

@section('meta_title', '')

@section('meta_description', '')

@section('head')

@endsection

@section('header-class', 'extra-header')

@section('content')

  <div class="sub_header_in sticky_header sub-header-indigo">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <h1>Аккаунт</h1>
        </div>
        <div class="col-lg-6 text-right">
          <a href="/{{ $lang }}/my-ads/create" class="btn_add btn-yellow">Добавить объявления</a>
        </div>
      </div>
    </div>
  </div>

  <div class="container margin_80_55">
    <div class="row">
      <div class="col-lg-3">
        @include('account.menu')
      </div>
      @foreach($products as $product)
        <?php $product_lang = $product->products_lang->where('lang', $lang)->first(); ?>
        <div class="col-xl-4 col-lg-6 col-md-6">
          <div class="strip grid">
            <figure>
              <a href="/{{ $lang.'/'.Str::limit($product_lang['slug'], 35).'/'.'p-'.$product->id }}"><img src="/img/products/{{ $product->path.'/'.$product->image }}" class="img-fluid" alt="{{ $product_lang['title'] }}">
                <div class="read_more"><span>Подробнее</span></div>
              </a>
              <small>{{ $product->company->title }}</small>
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
                <a href="/{{ $lang }}/my-ads/{{ $product->id }}/edit" class="btn_add">Редактировать</a>
              </li>
            </ul>
          </div>
        </div>
      @endforeach
    </div>
  </div>

@endsection