  @extends('layout')

@section('meta_title', 'Вход & Регистрация')

@section('meta_description', 'Вход & Регистрация на 5second')

@section('head')

@endsection

@section('header-class', 'extra-header')

@section('content')

  <div class="sub_header_in sticky_header sub-header-dark">
    <div class="container">
      <h1>Вход & Регистрация</h1>
    </div>
  </div>

  <main>
    <div class="container margin_60">
      @include('partials.alerts')

      <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-8">
          <div class="box_account">
            <h3 class="client">Вход</h3>
            <form method="POST" action="/{{ $lang }}/cs-login">
              @csrf
              <div class="form_container">
                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email*" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password*" required>
                </div>
                <div class="clearfix add_bottom_15">
                  <div class="checkboxes float-left">
                    <label class="container_check">Запомнить меня
                      <input type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="float-right"><a id="forgot" href="/javascript:void(0);">Забыли пароль?</a></div>
                </div>
                <div class="text-center"><input type="submit" value="Войти" class="btn_1 full-width"></div>
                <div id="forgot_pw">
                  <div class="form-group">
                    <input type="email" class="form-control" name="email_forgot" id="email_forgot" placeholder="Type your email">
                  </div>
                  <p>A new password will be sent shortly.</p>
                  <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
                </div>
              </div>
            </form>
          </div>
          <div class="row hidden_tablet">
            <div class="col-md-6">
              <ul class="list_ok">
                <li>База профессионалов</li>
                <li>Проверка качества</li>
                <li>Защита данных</li>
              </ul>
            </div>
            <div class="col-md-6">
              <ul class="list_ok">
                <li>Безопасные платежи</li>
                <li>Поддержка 24ч</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-8">
          <div class="box_account">
            <h3 class="new_client">Регистрация</h3> <small class="float-right pt-2">* Обязательные поля</small>

            <form method="POST" action="/{{ $lang }}/cs-register">
              @csrf
              <div class="form_container">
                <div class="row no-gutters">
                  <div class="col-6 pr-1">
                    <div class="form-group">
                      <input type="text" class="form-control" minlength="2" maxlength="40" name="name" placeholder="Имя*" value="{{ old('name') }}" required>
                    </div>
                  </div>
                  <div class="col-6 pl-1">
                    <div class="form-group">
                      <input type="text" class="form-control" minlength="2" maxlength="60" name="surname" placeholder="Фамилия*" value="{{ old('surname') }}" required>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="form-group">
                  <input type="tel" pattern="(\+?\d[- .]*){7,13}" class="form-control" name="phone" placeholder="Номер телефона*" value="{{ old('phone') }}" required>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email*" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" id="password" minlength="2" maxlength="60" value="" placeholder="Придумайте пароль*" required>
                </div>
                <hr>
                <div class="form-group">
                  <input type="text" class="form-control" name="gov_number" minlength="3" maxlength="30" placeholder="Гос. номер*" value="{{ old('gov_number') }}" >
                </div>
                <div class="form-group">
                  <div><label>Тип карты</label></div>
                  @foreach(trans('data.card_types') as $key => $card_type)
                    <label class="container_radio" style="display: inline-block; margin-right: 15px;">{{ $card_type }}
                      <input type="radio" name="card_type" checked="" value="{{ $key }}">
                      <span class="checkmark"></span>
                    </label>
                  @endforeach
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="barcode" placeholder="Штрих код карты*" value="{{ old('barcode') }}">
                </div><br>
                <!-- <div class="form-group">
                  <label class="container_check">Accept <a href="/#0">Terms and conditions</a>
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div> -->
                <div class="text-center"><input type="submit" value="Регистрация" class="btn_1 full-width"></div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection