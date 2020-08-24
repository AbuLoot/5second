@extends('layout')

@section('meta_title', '')

@section('meta_description', '')

@section('head')
  <!-- SPECIFIC CSS -->
  <link href="/css/tables.css" rel="stylesheet">
@endsection

@section('header-class', 'extra-header')

@section('content')

  <div class="sub_header_in sticky_header sub-header-dark">
    <div class="container">
      <h1>Выбор карты</h1>
    </div>
  </div>

  <main>
    <div class="container margin_60_35">
      <div class="pricing-container cd-has-margins">
        <ul class="pricing-list bounce-invert">
          @foreach($cards as $card)
            <li @if($card->slug == 'gold') class="popular" @endif>
              <ul class="pricing-wrapper">
                <li data-type="monthly" class="is-visible">
                  <header class="pricing-header">
                    <h2>{{ $card->title }}</h2>
                    <img src="/img/{{ $card->image }}" class="img-fluid">

                    <div class="price">
                      <span class="price-value">{{ $card->price }}</span>
                      <span class="currency">₸</span>
                      <span class="price-duration">мес.</span>
                    </div>
                  </header>
                  <!-- /pricing-header -->
                  <div class="pricing-body">
                    <ul class="pricing-features">
                      <li>Лимит ползователей: <em>{{ $card->user_number }}</em></li>
                      <li>Лимит автомобилей: <em>{{ $card->user_number }}</em></li>
                      <li>Лимит услуг: <em>{{ ($card->service_number == 0) ? 'Безлимитный' : $card->service_number }}</em></li>
                      @if($card->slug == 'platinum')
                        <li>Срок: <em>Безлимитный</em></li>
                      @else
                        <li>Срок: <em>30 дней</em></li>
                      @endif
                      <li>Поддержка: <em>24/7</em></li>
                    </ul>
                  </div>
                  <footer class="pricing-footer">
                    <a class="select-plan" href="/{{ $lang }}/set-card/{{ $card->slug }}">Выбрать</a>
                  </footer>
                </li>
              </ul>
            </li>
          @endforeach
        </ul>
      </div>
    </div>

  </main>

@endsection

@section('scripts')
  <!-- SPECIFIC SCRIPTS -->
  <script src="/js/modernizr_tables.js"></script>
  <script src="/js/tables_func.js"></script>
@endsection
