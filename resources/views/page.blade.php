@extends('layout')

@section('meta_title', $page->meta_title)

@section('meta_description', $page->meta_description)

@section('head')

@endsection

@section('header-class', 'extra-header')

@section('content')

  <div class="sub_header_in sticky_header sub-header-indigo">
    <div class="container">
      <h1>{{ $page->title }}</h1>
    </div>
  </div>

  <div class="container margin_80_55">
    <div class="main_title_2">
      <span><em></em></span>
      <h2>{{ $page->title }}</h2>
      <p>{{ $page->title_extra }}</p>
    </div>
    <div class="row">
      <div class="col-md-8 offset-md-2">
        {!! $page->content !!}
      </div>
    </div>
  </div>

@endsection