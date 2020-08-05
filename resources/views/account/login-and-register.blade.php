@extends('layout')

@section('meta_title', '')

@section('meta_description', '')

@section('head')

@endsection

@section('header-class', 'extra-header')

@section('content')

  <div class="sub_header_in sticky_header sub-header-indigo">
    <div class="container">
      <h1>Вход & Регистрация</h1>
    </div>
  </div>

  <main>
    <div class="container margin_60">
      <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-6 col-md-8">
        <div class="box_account">
          <h3 class="client">Вход</h3>
          <div class="form_container">
            <div class="form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="Email*">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password_in" id="password_in" value="" placeholder="Password*">
            </div>
            <div class="clearfix add_bottom_15">
              <div class="checkboxes float-left">
                <label class="container_check">Remember me
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="float-right"><a id="forgot" href="/javascript:void(0);">Lost Password?</a></div>
            </div>
            <div class="text-center"><input type="submit" value="Log In" class="btn_1 full-width"></div>
            <div id="forgot_pw">
              <div class="form-group">
                <input type="email" class="form-control" name="email_forgot" id="email_forgot" placeholder="Type your email">
              </div>
              <p>A new password will be sent shortly.</p>
              <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
            </div>
          </div>
        </div>
        <div class="row hidden_tablet">
          <div class="col-md-6">
            <ul class="list_ok">
              <li>Find Locations</li>
              <li>Quality Location check</li>
              <li>Data Protection</li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="list_ok">
              <li>Secure Payments</li>
              <li>H24 Support</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-8">
        <div class="box_account">
          <h3 class="new_client">Регистрация</h3> <small class="float-right pt-2">* Обязательные поля</small>
          <div class="form_container">
            <div class="row no-gutters">
              <div class="col-6 pr-1">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Имя*">
                </div>
              </div>
              <div class="col-6 pl-1">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Фамилия*">
                </div>
              </div>
            </div>
            <hr>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Telephone *">
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="Email*">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password_in_2" id="password_in_2" value="" placeholder="Придумайте пароль*">
            </div>
            <hr>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Гос. номер*">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Штрих код карты*">
            </div>
            <div class="form-group">
              <div><label>Тип карты</label></div>
              @foreach(trans('data.card_types') as $key => $card_type)
                <label class="container_radio" style="display: inline-block; margin-right: 15px;">{{ $card_type }}
                  <input type="radio" name="client_type" checked="" value="{{ $key }}">
                  <span class="checkmark"></span>
                </label>
              @endforeach
            </div>
            <div class="row no-gutters">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="custom-select-form">
                    <select class="wide add_bottom_10" name="country" id="country">
                      <option value="" selected>Регион*</option>
                      <?php $traverse = function ($nodes, $prefix = null) use (&$traverse) { ?>
                        <?php foreach ($nodes as $node) : ?>
                          <option value="{{ $node->id }}">{{ PHP_EOL.$prefix.' '.$node->title }}</option>
                          <?php $traverse($node->children, $prefix.'___'); ?>
                        <?php endforeach; ?>
                      <?php }; ?>
                      <?php $traverse($regions); ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="container_check">Accept <a href="/#0">Terms and conditions</a>
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="text-center"><input type="submit" value="Register" class="btn_1 full-width"></div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </main>

@endsection