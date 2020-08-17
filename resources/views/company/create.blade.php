@extends('layout')

@section('meta_title', '')

@section('meta_description', '')

@section('head')

@endsection

@section('header-class', 'extra-header')

@section('content')

  <div class="sub_header_in sticky_header sub-header-indigo">
    <div class="container">
      <h1>Компании</h1>
    </div>
  </div>

  <div class="container margin_80_55">
    <div class="row">
      <div class="col-lg-3">
        @include('account.menu')
      </div>
      <div class="col-lg-9">
        <form action="/{{ $lang }}/my-companies" method="post" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <div class="box_detail padding_bottom">
            <div class="header_box version_2">
              <h2><i class="fa fa-user"></i>Создание компании</h2>
            </div>
            <div class="row">
              <div class="col-lg-9">
                <div class="form-group">
                  <label for="title">Название</label>
                  <input type="text" class="form-control" id="title" name="title" minlength="2" maxlength="80" value="{{ (old('title')) ? old('title') : '' }}" required>
                </div>
                <div class="form-group">
                  <label for="region_id">Регионы</label>
                  <select id="region_id" name="region_id" class="form-control">
                    <option value=""></option>
                    <?php $traverse = function ($nodes, $prefix = null) use (&$traverse) { ?>
                      <?php foreach ($nodes as $node) : ?>
                        <option value="{{ $node->id }}">{{ PHP_EOL.$prefix.' '.$node->title }}</option>
                        <?php $traverse($node->children, $prefix.'___'); ?>
                      <?php endforeach; ?>
                    <?php }; ?>
                    <?php $traverse($regions); ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="address">Адрес</label>
                  <input type="text" class="form-control" id="address" name="address" value="{{ (old('address')) ? old('address') : NULL }}">
                </div>
                <div class="form-group">
                  <label for="image">Логотип</label><br>
                  <input type="file" name="image" accept="image/*">
                </div>
                <div class="form-group">
                  <label for="about">О компании</label>
                  <textarea class="form-control" id="about" name="about" rows="5">{{ (old('about')) ? old('about') : '' }}</textarea>
                </div>
                <div class="form-group">
                  <label for="phones">Номера телефонов</label>
                  <input type="text" class="form-control" id="phones" name="phones" value="{{ (old('phones')) ? old('phones') : NULL }}">
                </div>
                <div class="form-group">
                  <label for="links">Website</label>
                  <input type="text" class="form-control" id="links" name="links" value="{{ (old('links')) ? old('links') : NULL }}">
                </div>
                <div class="form-group">
                  <label for="emails">Emails</label>
                  <input type="text" class="form-control" id="emails" name="emails" value="{{ (old('emails')) ? old('emails') : NULL }}">
                </div>
                <p><button type="submit" class="btn_1 medium">Создать</button></p>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
