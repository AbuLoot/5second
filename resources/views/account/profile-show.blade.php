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
      <div class="col-lg-5">
        <div class="box_detail">
          <h2><i class="fa fa-user"></i> {{ $user->name.' '.$user->surname }}</h2>
          <dl class="row">
            @if($user->companies->isNotEmpty())
              <dt class="col-sm-5">Мои компании</dt>
              <dd class="col-sm-7">
                @foreach($user->companies as $company)
                  {{ $company->title }}<br>
                @endforeach
              </dd>
            @endif

            <dt class="col-sm-5">Email</dt>
            <dd class="col-sm-7">{{ $user->email }}</dd>

            <dt class="col-sm-5">Номер телефона</dt>
            <dd class="col-sm-7">{{ $user->profile->phone }}</dd>

            <dt class="col-sm-5">Баланс</dt>
            <dd class="col-sm-7">{{ $user->balance }}</dd>

            <dt class="col-sm-5">Город</dt>
            <dd class="col-sm-7">{{ \App\Region::find($user->profile->region_id)->title }}</dd>

            <dt class="col-sm-5">Гос. номер</dt>
            <dd class="col-sm-7">{{ $user->profile->gov_number }}</dd>

            <dt class="col-sm-5">Тип карты</dt>
            <dd class="col-sm-7">{{ trans('data.card_types.'.$user->profile->card_type) }}</dd>

            <!-- <dt class="col-sm-5">Штрих код</dt>
            <dd class="col-sm-7">{{ $user->profile->barcode }}</dd> -->

            <dt class="col-sm-5">Дата рождения</dt>
            <dd class="col-sm-7">{{ $user->profile->birthday }} </dd>

            <dt class="col-sm-5">Пол</dt>
            <dd class="col-sm-7">{{ trans('data.sex.'.$user->profile->sex) }}</dd>

            <dt class="col-sm-5">О себе</dt>
            <dd class="col-sm-7">{{ $user->profile->about }} </dd>
          </dl>
        </div>
        <p><a href="/{{ $lang }}/my-profile/{{ $user->id }}/edit" class="btn_1 medium">Редактировать</a></p>
      </div>
      <div class="col-lg-4">
        <div class="box_detail">
          <h2>Карта {{ trans('data.card_types.'.$user->profile->card_type) }}</h2>
          <dl class="row">
            <dt class="col-sm-5">Штрих код</dt>
            <dd class="col-sm-7">{{ $user->profile->barcode }}</dd>
          </dl>
          <img src="/img/cards/{{ $user->profile->card_type }}.jpg" class="img-fluid mb-2">
          <!-- <div class="p-3 mb-2 bg-success text-white">Активный</div> -->
          <div class="p-3 mb-2 bg-secondary text-white h4">Неактивный</div>
          <div class="mb-2 ">
            <a href="/{{ $lang }}/card-selection" class="btn_1 medium-">Изменить карту</a>
          </div>
          <div>
            <a href="/{{ $lang }}/my-profile/{{ $user->id }}/edit" class="btn_1 medium-">Активировать</a>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
