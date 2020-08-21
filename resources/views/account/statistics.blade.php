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
          <h1>Статистика</h1>
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
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <a class="box_feat" href="#0">
              <i class="pe-7s-shopbag"></i>
              <h3>Объявлении: {{ $count_ads }}</h3>
            </a>
          </div>
          <div class="col-lg-4 col-md-6">
            <a class="box_feat" href="#0">
              <i class="pe-7s-paper-plane"></i>
              <h3>Заявок: {{ $count_apps }}</h3>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection