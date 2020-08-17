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
        <form action="/{{ $lang }}/my-companies/{{ $company->id }}" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_method" value="PUT">
          {!! csrf_field() !!}
          <div class="box_detail padding_bottom">
            <div class="header_box version_2">
              <h2><i class="fa fa-user"></i>Редактирование компании</h2>
            </div>
            <div class="row">
              <div class="col-lg-9">
                <div class="form-group">
                  <label for="title">Название</label>
                  <input type="text" class="form-control" id="title" name="title" minlength="2" maxlength="80" value="{{ (old('title')) ? old('title') : $company->title }}" required>
                </div>
                <div class="form-group">
                  <label for="region_id">Регионы</label>
                  <select id="region_id" name="region_id" class="form-control">
                    <option value=""></option>
                    <?php $traverse = function ($nodes, $prefix = null) use (&$traverse, $company) { ?>
                      <?php foreach ($nodes as $node) : ?>
                        <option value="{{ $node->id }}" <?= ($node->id == $company->region_id) ? 'selected' : ''; ?>>{{ PHP_EOL.$prefix.' '.$node->title }}</option>
                        <?php $traverse($node->children, $prefix.'___'); ?>s
                      <?php endforeach; ?>
                    <?php }; ?>
                    <?php $traverse($regions); ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="address">Адрес</label>
                  <input type="text" class="form-control" id="address" name="address" value="{{ (old('address')) ? old('address') : $company->address }}">
                </div>
                <div class="form-group">
                  <label for="image">Логотип</label><br>
                  <img src="/img/companies/{{ $company->image }}" style="max-width: 300px">
                  <input type="file" name="image" accept="image/*">
                </div>
                <div class="form-group">
                  <label for="about">О компании</label>
                  <textarea class="form-control" id="about" name="about" rows="5">{{ (old('about')) ? old('about') : $company->about }}</textarea>
                </div>
                <div class="form-group">
                  <label for="phones">Номера телефонов</label>
                  <input type="text" class="form-control" id="phones" name="phones" value="{{ (old('phones')) ? old('phones') : $company->phones }}">
                </div>
                <div class="form-group">
                  <label for="links">Website</label>
                  <input type="text" class="form-control" id="links" name="links" value="{{ (old('links')) ? old('links') : $company->links }}">
                </div>
                <div class="form-group">
                  <label for="emails">Emails</label>
                  <input type="text" class="form-control" id="emails" name="emails" value="{{ (old('emails')) ? old('emails') : $company->emails }}">
                </div>
                <p><button type="submit" class="btn_1 medium">Редактировать</button></p>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection