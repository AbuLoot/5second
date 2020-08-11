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
        @include('account.menu')
      </div>
      <div class="col-lg-9">
        <div class="box_detail padding_bottom">
          <h2><i class="fa fa-user"></i> {{ $user->name.' '.$user->surname }}</h2>
          <dl class="row">
            <dt class="col-sm-3">Мои компании</dt>
            <dd class="col-sm-9">
              @foreach($user->companies as $company)
                {{ $company->title }}<br>
              @endforeach
            </dd>

            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">{{ $user->email }}</dd>

            <dt class="col-sm-3">Номер телефона</dt>
            <dd class="col-sm-9">{{ $user->profile->phone }}</dd>

            <dt class="col-sm-3">Баланс</dt>
            <dd class="col-sm-9">{{ $user->balance }}</dd>

            <dt class="col-sm-3">Город</dt>
            <dd class="col-sm-9">{{ \App\Region::find($user->profile->region_id)->title }}</dd>

            <dt class="col-sm-3 text-truncate">Гос. номер</dt>
            <dd class="col-sm-9">{{ $user->profile->gov_number }}</dd>

            <dt class="col-sm-3 text-truncate">Тип карты</dt>
            <dd class="col-sm-9">{{ $user->profile->card_type }}</dd>

            <dt class="col-sm-3 text-truncate">Штрих код</dt>
            <dd class="col-sm-9">{{ $user->profile->barcode }}</dd>

            <dt class="col-sm-3 text-truncate">Дата рождения</dt>
            <dd class="col-sm-9">{{ $user->profile->birthday }} </dd>

            <dt class="col-sm-3 text-truncate">Пол</dt>
            <dd class="col-sm-9">{{ trans('data.sex.'.$user->profile->sex) }}</dd>

            <dt class="col-sm-3 text-truncate">О себе</dt>
            <dd class="col-sm-9">{{ $user->profile->about }} </dd>
          </dl>
        </div>
        <p><a href="/{{ $lang }}/my-profile/{{ $user->id }}/edit" class="btn_1 medium">Редактировать</a></p>
      </div>
    </div>
  </div>

@endsection