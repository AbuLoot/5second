@extends('layout')

@section('meta_title', '')

@section('meta_description', '')

@section('head')

@endsection

@section('header-class', 'extra-header')

@section('content')

  <div class="sub_header_in sticky_header sub-header-dark">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <h1>Заявки</h1>
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
      <div class="col-lg-9">
        @foreach($apps as $app)
          <div class="box_detail">
            <h2>{{ $app->name }} / {{ $app->created_at }}</h2>
            <dl class="row">
              <dt class="col-sm-3">Номер телефона</dt>
              <dd class="col-sm-9">{{ $app->phone }}</dd>

              <!-- <dt class="col-sm-3">Email</dt>
              <dd class="col-sm-9">{{ $app->email }}</dd> -->

              <dt class="col-sm-3 text-truncate">Компания</dt>
              <dd class="col-sm-9">{{ \App\Company::find($app->company_id)->title }}</dd>

              <dt class="col-sm-3 text-truncate">Объявление</dt>
              <dd class="col-sm-9">
                <?php $product = \App\Product::find($app->file); ?>
                <?php $product_lang = $product->products_lang->where('lang', $lang)->first(); ?>
                <a href="/{{ $lang.'/'.Str::limit($product_lang['slug'], 35).'/'.'p-'.$product->id }}"><?php echo $product_lang->title; ?></a>
              </dd>

              <dt class="col-sm-3 text-truncate">Забронировано на:</dt>
              <dd class="col-sm-9">{{ $app->message }}</dd>
            </dl>
          </div>
        @endforeach

        <div class="text-center">
          {{ $apps->links() }}
        </div>
      </div>
    </div>
  </div>

@endsection