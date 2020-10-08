@extends('layout')

@section('meta_title', 'Аккаунт')

@section('meta_description', 'Аккаунт')

@section('head')

@endsection

@section('header-class', 'extra-header')

@section('content')

  <div class="sub_header_in sticky_header sub-header-dark">
    <div class="container">
      <h1>Редактирование аккаунта</h1>
    </div>
  </div>

  <div class="container margin_80_55">
    @include('partials.alerts')
    <div class="row">
      <div class="col-lg-3">
        @include('account.menu')
      </div>
      <div class="col-lg-9">
        <form action="/{{ $lang }}/my-profile/{{ $user->id }}" method="post">
          <input type="hidden" name="_method" value="PUT">
          {!! csrf_field() !!}
          <div class="box_detail padding_bottom">
            <div class="header_box version_2">
              <h2>Рекдактирование профиля</h2>
            </div>
            <div class="row">
              <div class="col-md-8 add_top_30">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label>Имя</label>
                      <input type="text" class="form-control" minlength="2" maxlength="40" name="name" placeholder="Имя*" value="{{ (old('name')) ? old('name') : $user->name }}" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label>Фамилия</label>
                      <input type="text" class="form-control" minlength="2" maxlength="60" name="surname" placeholder="Фамилия*" value="{{ (old('surname')) ? old('surname') : $user->surname }}" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Регион</label>
                  <select id="region_id" name="region_id" class="form-control">
                    <option value=""></option>
                    <?php $traverse = function ($nodes, $prefix = null) use (&$traverse, $user) { ?>
                      <?php foreach ($nodes as $node) : ?>
                        <option value="{{ $node->id }}" <?= ($node->id == $user->profile->region_id) ? 'selected' : ''; ?>>{{ PHP_EOL.$prefix.' '.$node->title }}</option>
                        <?php $traverse($node->children, $prefix.'___'); ?>s
                      <?php endforeach; ?>
                    <?php }; ?>
                    <?php $traverse($regions); ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Номер телефона</label>
                  <input type="tel" pattern="(\+?\d[- .]*){7,13}" class="form-control" name="phone" placeholder="Номер телефона*" value="{{ (old('phone')) ? old('phone') : $user->profile->phone }}" required>
                </div>
                <div class="form-group">
                  <label>Гос. номер*</label>
                  <input type="text" class="form-control" name="gov_number" minlength="3" maxlength="30" placeholder="Гос. номер*" value="{{ (old('gov_number')) ? old('gov_number') : $user->privilege->gov_number }}" required>
                </div>
                <div class="form-group">
                  <div><label>Тип карты</label></div>
                  @foreach(trans('data.card_types') as $key => $card_type)
                    <label class="container_radio" style="display: inline-block; margin-right: 15px;">{{ $card_type }}
                      <input type="radio" name="card_type" value="{{ $key }}" @if($key == $user->privilege->card_type) checked="checked" @endif>
                      <span class="checkmark"></span>
                    </label>
                  @endforeach
                </div>
                <div class="form-group">
                  <label>Штрих код карты</label>
                  <input type="text" class="form-control" name="barcode" placeholder="Штрих код карты*" value="{{ (old('barcode')) ? old('barcode') : $user->privilege->barcode }}">
                </div>
                <div class="form-group">
                  <label>Дата рождения</label>
                  <input type="date" class="form-control" name="birthday" minlength="3" maxlength="30" placeholder="Дата рождения" value="{{ (old('birthday')) ? old('birthday') : $user->profile->birthday }}" >
                </div>
                <div class="form-group">
                  <div><label>Пол</label></div>
                  @foreach(trans('data.sex') as $key => $value)
                    <label class="container_radio" style="display: inline-block; margin-right: 15px;">{{ $value }}
                      <input type="radio" name="sex" @if($key == $user->profile->sex) checked="checked" @endif value="{{ $key }}">
                      <span class="checkmark"></span>
                    </label>
                  @endforeach
                </div>
                <div class="form-group">
                  <label for="about">О себе</label>
                  <textarea class="form-control" id="about" name="about" rows="5">{{ (old('about')) ? old('about') : $user->profile->about }}</textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="box_detail padding_bottom">
                <div class="header_box version_2">
                  <h2><i class="fa fa-lock"></i>Изменить пароль</h2>
                </div>
                <div class="form-group">
                  <label>Старый пароль</label>
                  <input class="form-control" name="old_password" type="password">
                </div>
                <div class="form-group">
                  <label>Новый пароь</label>
                  <input class="form-control" name="new_password" type="password">
                </div>
                <div class="form-group">
                  <label>Подтвердите новый пароль</label>
                  <input class="form-control" name="confirm_new_password" type="password">
                </div>
              </div>
            </div>
          </div>
          <p><button type="submit" class="btn_1 medium">Сохранить</button></p>
        </form>
      </div>
    </div>
  </div>

@endsection