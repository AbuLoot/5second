@extends('layout')

@section('meta_title', 'Компании')

@section('meta_description', 'Компании')

@section('head')

@endsection

@section('header-class', 'extra-header')

@section('content')

  <div class="sub_header_in sticky_header sub-header-dark">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <h1>Компании</h1>
        </div>
        <div class="col-lg-6 text-right">
          <a href="/{{ $lang }}/my-companies/create" class="btn_add btn-yellow">Добавить компанию</a>
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
        @foreach($user->companies as $company)
          <div class="box_detail">
            <h2>{{ $company->title }}</h2>
            <dl class="row">
              <dt class="col-sm-3">Email</dt>
              <dd class="col-sm-9">{{ $company->emails }}</dd>

              <dt class="col-sm-3">Номер телефона</dt>
              <dd class="col-sm-9">{{ $company->phones }}</dd>

              <dt class="col-sm-3"><img src="/img/companies/{{ $company->image }}" class="img-fluid"></dt>
              <dd class="col-sm-9">{{ $company->about }}</dd>

              <dt class="col-sm-3 text-truncate">Ссылки</dt>
              <dd class="col-sm-9">{{ $company->links }}</dd>

              <dt class="col-sm-3 text-truncate">Адрес</dt>
              <dd class="col-sm-9">{{ $company->address }}</dd>

              <dt class="col-sm-3 text-truncate">График</dt>
              <dd class="col-sm-9">{{ $company->schedule }}</dd>
            </dl>
            <p><a href="/{{ $lang }}/my-companies/{{ $company->id }}/edit" class="btn_1 medium">Редактировать</a></p>
          </div>
        @endforeach
      </div>
    </div>
  </div>

@endsection
