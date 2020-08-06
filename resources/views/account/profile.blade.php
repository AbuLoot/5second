@extends('layout')

@section('meta_title', '')

@section('meta_description', '')

@section('head')

@endsection

@section('header-class', 'extra-header')

@section('content')

  <div class="sub_header_in sticky_header sub-header-indigo">
    <div class="container">
      <h1>Аккаунт</h1>
    </div>
  </div>

  <div class="container margin_80_55">
    <div class="row">
      <div class="col-lg-3">
        <div class="box_style_cat">
          <ul id="cat_nav">
            <li><a href="/{{ $lang }}/my-profile" class="active">Мой профиль</a></li>
            <li><a href="/{{ $lang }}/my-ads" class="">Мои объявления</a></li>
            <li><a href="/{{ $lang }}/my-orders" class="">Мои заказы</a></li>
            <li><a href="/{{ $lang }}/statistics" class="">Статистика</a></li>
            <li><a href="/{{ $lang }}/reccomendations" class="">Выход</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="box_detail padding_bottom">
          <h2><i class="fa fa-user"></i> {{ $user->name.' '.$user->surname }}</h2>
          <dl class="row">
            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">{{ $user->email }}</dd>

            <dt class="col-sm-3">Номер телефона</dt>
            <dd class="col-sm-9">{{ $user->profile->phone }}</dd>

            <dt class="col-sm-3">Баланс</dt>
            <dd class="col-sm-9">{{ $user->balance }}</dd>

            <dt class="col-sm-3 text-truncate">Гос. номер</dt>
            <dd class="col-sm-9">{{ $user->profile->gov_number }}</dd>

            <dt class="col-sm-3 text-truncate">Тип карты</dt>
            <dd class="col-sm-9">{{ $user->profile->card_type }}</dd>

            <dt class="col-sm-3 text-truncate">Штрих код</dt>
            <dd class="col-sm-9">{{ $user->profile->barcode }}</dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

@endsection