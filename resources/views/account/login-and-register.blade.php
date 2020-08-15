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
          <h3 class="new_client">Регистрация</h3> <small class="float-right pt-2">* Required Fields</small>
          <div class="form_container">
            <div class="form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="Email*">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password_in_2" id="password_in_2" value="" placeholder="Password*">
            </div>
            <hr>
            <div class="form-group">
              <label class="container_radio" style="display: inline-block; margin-right: 15px;">Private
                <input type="radio" name="client_type" checked value="private">
                <span class="checkmark"></span>
              </label>
              <label class="container_radio" style="display: inline-block;">Company
                <input type="radio" name="client_type" value="company">
                <span class="checkmark"></span>
              </label>
            </div>
            <div class="private box">
              <div class="row no-gutters">
                <div class="col-6 pr-1">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name*">
                  </div>
                </div>
                <div class="col-6 pl-1">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Last Name*">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Full Address*">
                  </div>
                </div>
              </div>
              <div class="row no-gutters">
                <div class="col-6 pr-1">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="City*">
                  </div>
                </div>
                <div class="col-6 pl-1">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Postal Code*">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <div class="custom-select-form">
                      <select class="wide add_bottom_10" name="country" id="country">
                          <option value="" selected>Country*</option>
                          <option value="Europe">Europe</option>
                          <option value="United states">United states</option>
                          <option value="Asia">Asia</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Telephone *">
                  </div>
                </div>
              </div>
            </div>
            <div class="company box" style="display: none;">
              <div class="row no-gutters">
                <div class="col-12">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Company Name*">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Full Address">
                  </div>
                </div>
              </div>
              <div class="row no-gutters">
                <div class="col-6 pr-1">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="City*">
                  </div>
                </div>
                <div class="col-6 pl-1">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Postal Code*">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <div class="custom-select-form">
                      <select class="wide add_bottom_10" name="country" id="country">
                          <option value="" selected>Country*</option>
                          <option value="Europe">Europe</option>
                          <option value="United states">United states</option>
                          <option value="Asia">Asia</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Telephone *">
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label class="container_check">Accept <a href="/#0">Terms and conditions</a>
                <input type="checkbox">
                <span class="checkmark"></span>
              </label>
            </div>
            <div class="text-center"><input type="submit" value="Register" class="btn_1 full-width"></div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </main>

@endsection