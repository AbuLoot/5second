<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="SPARKER - Premium directory and listings template by Ansonika.">
  <meta name="author" content="Ansonika">
  <title>@yield('meta_title', '5 second - Скидки на все виды автоуслуг от 10 до 90%')</title>

  <!-- Favicons-->
  <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" type="image/x-icon" href="/img/apple-touch-icon-57x57-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="/img/apple-touch-icon-72x72-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="/img/apple-touch-icon-114x114-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="/img/apple-touch-icon-144x144-precomposed.png">

  <!-- GOOGLE WEB FONT -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- BASE CSS -->
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <link href="/css/vendors.css" rel="stylesheet">

  <!-- YOUR CUSTOM CSS -->
  <link href="/css/custom.css" rel="stylesheet">
  <script src="https://api-maps.yandex.ru/2.1/?apikey=f8a0ddb3-4528-4fd3-a6b1-db34eddbcd7a&lang=ru_RU" type="text/javascript"> </script>
  @yield('head')

  @if($section_codes->firstWhere('slug', 'header-code'))
    {{ $section_codes->firstWhere('slug', 'header-code')->content }}
  @endif
</head>
<body>
<div id="page">

  <header class="header menu_fixed @yield('header-class')">
    <div id="logo">
      <a href="/" title="5 Second">
        <img src="/img/brand/@yield('logo', 'logo-black-200x51.png')" width="150" alt="" class="logo_normal">
        <img src="/img/brand/logo-black-200x51.png" width="150" alt="" class="logo_sticky">
      </a>
    </div>
    <ul id="top_menu">
      @guest
        <li><a href="/{{ $lang }}/cs-login-and-register" class="login" title="Sign In">Войти</a></li>
      @else
        <li><a href="/{{ $lang }}/my-profile" class="btn-header "><span class="pe-7s-user"></span></a></li>
      @endguest
    </ul>
    <a href="#menu" class="btn_mobile">
      <div class="hamburger hamburger--spin" id="hamburger">
        <div class="hamburger-box">
          <div class="hamburger-inner"></div>
        </div>
      </div>
    </a>
    <nav id="menu" class="main-menu">
      <ul>
        <?php $traverse = function ($categories) use (&$traverse, $lang) { ?>
          <?php foreach ($categories as $category) : ?>
            <?php if ($category->isRoot() && $category->descendants->count() > 0) : ?>
              <li>
                <span><a href="/{{ $lang.'/'.$category->slug.'/c-'.$category->id }}">{{ $category->title }}</a></span>
                <ul>
                  <?php $traverse($category->children); ?>
                </ul>
              </li>
            <?php elseif ($category->ancestors->count() > 0) : ?>
              <li>
                <a href="/{{ $lang.'/'.$category->slug.'/c-'.$category->id }}">{{ $category->title }}</a>
              </li>
            <?php else : ?>
              <li>
                <span><a href="/{{ $lang.'/'.$category->slug.'/c-'.$category->id }}">{{ $category->title }}</a></span>
              </li>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php }; ?>
        <?php $traverse($categories); ?>
      </ul>
    </nav>
  </header>

  <main class="pattern">
    @yield('content')
  </main>

  <footer class="plus_border">
    <div class="container margin_60_35">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <h3 data-target="#collapse_ft_1">Страницы</h3>
          <div class="collapse dont-collapse-sm" id="collapse_ft_1">
            <ul class="links">
              <?php $traverse = function ($pages) use (&$traverse, $lang) { ?>
                <?php foreach ($pages as $page) : ?>
                  <?php if ($page->isRoot() && $page->descendants->count() > 0) : ?>
                    <li>
                      <a href="/{{ $lang }}/i/{{ $page->slug }}">{{ $page->title }}</a>
                      <ul>
                        <?php $traverse($page->children, $page->slug.'/'); ?>
                      </ul>
                    </li>
                  <?php else : ?>
                    <li>
                      <a href="/{{ $lang }}/i/{{ $page->slug }}">{{ $page->title }}</a>
                    </li>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php }; ?>
              <?php $traverse($pages); ?>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <h3 data-target="#collapse_ft_3">Контакты</h3>
          <?php
            $contacts = $section->firstWhere('slug', 'contacts');
            $data_phones = unserialize($contacts->data_1);
            $phones = explode('/', $data_phones['value']);
            $data_email = unserialize($contacts->data_2);
            $data_address = unserialize($contacts->data_3);
          ?>
          <div class="collapse dont-collapse-sm" id="collapse_ft_3">
            <ul class="contacts">
              <li><i class="ti-home"></i>{{ $data_address['value'] }}</li>
              @foreach ($phones as $phone)
                <li><i class="ti-headphone-alt"></i><a href="tel:{{ $phone }}">{{ $phone }}</a></li>
              @endforeach
              <li><i class="ti-email"></i><a href="mailto:{{ $data_email['value'] }}">{{ $data_email['value'] }}</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <h3 data-target="#collapse_ft_4">Присоединяйся к нам</h3>
          <div class="collapse dont-collapse-sm" id="collapse_ft_4">
            <!-- <div id="newsletter">
              <div id="message-newsletter"></div>
              <form method="post" action="assets/newsletter.php" name="newsletter_form" id="newsletter_form">
                <div class="form-group">
                  <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
                  <input type="submit" value="Submit" id="submit-newsletter">
                </div>
              </form>
            </div> -->
            <div class="follow_us">
              <!-- <h5>Присоединяйся к нам</h5> -->
              <ul>
                <li><a href="#0"><i class="ti-facebook"></i></a></li>
                <li><a href="#0"><i class="ti-twitter-alt"></i></a></li>
                <li><a href="#0"><i class="ti-google"></i></a></li>
                <li><a href="#0"><i class="ti-pinterest"></i></a></li>
                <li><a href="#0"><i class="ti-instagram"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-lg-6">
          <ul id="footer-selector">
            <li>
              <div class="styled-select" id="lang-selector">
                <select>
                  <option value="English" selected>English</option>
                  <option value="French">French</option>
                  <option value="Spanish">Spanish</option>
                  <option value="Russian">Russian</option>
                </select>
              </div>
            </li>
            <li>
              <div class="styled-select" id="currency-selector">
                <select>
                  <option value="US Dollars" selected>US Dollars</option>
                  <option value="Euro">Euro</option>
                </select>
              </div>
            </li>
            <li><img src="/img/cards_all.svg" alt=""></li>
          </ul>
        </div>
        <div class="col-lg-6">
          <ul id="additional_links">
            <li><a href="#0">Terms and conditions</a></li>
            <li><a href="#0">Privacy</a></li>
            <li><span>© 2020 Sparker</span></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  </div>

  <div id="toTop"></div><!-- Back to top button -->

  <!-- COMMON SCRIPTS -->
  <script src="/js/common_scripts.js"></script>
  <script src="/js/functions.js"></script>
  <script src="/assets/validate.js"></script>

  <!-- SPECIFIC SCRIPTS -->
  <!-- <script src="/js/animated_canvas_min.js"></script> -->

  @yield('scripts')

  @if($section_codes->firstWhere('slug', 'footer-code'))
    {{ $section_codes->firstWhere('slug', 'footer-code')->content }}
  @endif
  <script type="text/javascript">
    ymaps.ready(init);

    function init() {

      var myPlacemark,
        location = ymaps.geolocation

      location.get()
        .then(
          function(result) {
            var userAddress = result.geoObjects.get(0).properties.get('text');
            var userCoodinates = result.geoObjects.get(0).geometry.getCoordinates();
            firstGeoObject = result.geoObjects.get(0)
            city = (firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas())

            $.ajax({
              type: 'get',
              url: '/ru/set-region',
              dataType: 'json',
              data: {
                'city': city,
              },
              success: function(data) {
                alert(data);
                confirm('Ваш город: ' + city);
              }
            });
          },
          function(err) {
            console.log('Ошибка: ' + err)
          }
        );
    }
  </script>
</body>
</html>
