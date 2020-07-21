@extends('layout')

@section('meta_title', '')

@section('meta_description', '')

@section('head')

@endsection

@section('header-class', 'extra-header')

@section('content')

  <div id="results">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-10">
          <h4>Объектов <strong>145</strong></h4>
        </div>
        <div class="col-lg-8 col-md-8 col-2">
          <a href="#0" class="side_panel btn_search_mobile"></a> <!-- /open search panel -->
          <div class="row no-gutters custom-search-input-2 inner">
            <div class="col-lg-4">
              <div class="form-group">
                <input class="form-control" type="text" placeholder="Что вы ищите...">
                <i class="icon_search"></i>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <input class="form-control" type="text" placeholder="Где">
                <i class="icon_pin_alt"></i>
              </div>
            </div>
            <div class="col-lg-3">
              <select class="wide">
                <option>Все категории</option> 
                <option>Shops</option>
                <option>Hotels</option>
                <option>Restaurants</option>
                <option>Bars</option>
                <option>Events</option>
                <option>Fitness</option>
              </select>
            </div>
            <div class="col-lg-1">
              <input type="submit">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="filters_listing sticky_horizontal-">
    <div class="container">
      <ul class="clearfix">
        <li>
          <div class="switch-field">
            <input type="radio" id="all" name="listing_filter" value="all" checked>
            <label for="all">All</label>
            <input type="radio" id="popular" name="listing_filter" value="popular">
            <label for="popular">Popular</label>
            <input type="radio" id="latest" name="listing_filter" value="latest">
            <label for="latest">Latest</label>
          </div>
        </li>
        <li><a class="btn_filt" data-toggle="collapse" href="#filters" aria-expanded="false" aria-controls="filters" data-text-swap="Less filters" data-text-original="More filters">More filters</a></li>
        <li>
          <div class="layout_view">
            <a href="#0" class="active"><i class="icon-th"></i></a>
            <a href="listing-2.html"><i class="icon-th-list"></i></a>
            <a href="list-map.html"><i class="icon-map"></i></a>
          </div>
        </li>
        <li>
          <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
        </li>
      </ul>
    </div>
  </div>
  
  <div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
  </div>

  <!-- Filter list -->
  <div class="collapse" id="filters">
    <div class="container margin_30_5">
      <div class="row">
        <div class="col-md-4">
          <h6>Rating</h6>
          <ul>
            <li>
              <label class="container_check">Superb 9+ <small>34</small>
                <input type="checkbox">
                <span class="checkmark"></span>
              </label>
            </li>
            <li>
              <label class="container_check">Very Good 8+ <small>43</small>
                <input type="checkbox">
                <span class="checkmark"></span>
              </label>
            </li>
            <li>
              <label class="container_check">Good 7+ <small>67</small>
                <input type="checkbox">
                <span class="checkmark"></span>
              </label>
            </li>
            <li>
              <label class="container_check">Pleasant 6+ <small>89</small>
                <input type="checkbox">
                <span class="checkmark"></span>
              </label>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <h6>Tags</h6>
          <ul>
            <li>
              <label class="container_check">Wireless Internet <small>23</small>
                <input type="checkbox">
                <span class="checkmark"></span>
              </label>
            </li>
            <li>
              <label class="container_check">Smoking Allowed <small>43</small>
                <input type="checkbox">
                <span class="checkmark"></span>
              </label>
            </li>
            <li>
              <label class="container_check">Wheelchair Accesible <small>34</small>
                <input type="checkbox">
                <span class="checkmark"></span>
              </label>
            </li>
            <li>
              <label class="container_check">Parking <small>11</small>
                <input type="checkbox">
                <span class="checkmark"></span>
              </label>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <div class="add_bottom_30">
          <h6>Distance</h6>
            <div class="distance"> Radius around selected destination <span></span> km</div>
            <input type="range" min="10" max="100" step="10" value="30" data-orientation="horizontal">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container margin_60_35">

    <div class="row">
      @foreach($products_lang as $product_lang)
        <?php // $product_lang = $product_lang->product->products_lang->where('lang', $lang)->first(); ?>
        <div class="col-xl-4 col-lg-6 col-md-6">
          <div class="strip grid">
            <figure>
              <a href="/{{ $lang.'/'.Str::limit($product_lang['slug'], 35).'/'.'p-'.$product_lang->product->id }}"><img src="/img/products/{{ $product_lang->product->path.'/'.$product_lang->product->image }}" class="img-fluid" alt="{{ $product_lang['title'] }}">
                <div class="read_more"><span>Подробнее</span></div>
              </a>
              <!-- <small>Restaurant</small> -->
            </figure>
            <div class="wrapper">
              <h6><a href="/{{ $lang.'/'.Str::limit($product_lang['slug'], 35).'/'.'p-'.$product_lang->product->id }}">{{ $product_lang['title'] }}</a></h6>
              <small class="mb-0">{{ $product_lang->product->area }}</small>
            </div>
            <ul>
              <li>От {{ $product_lang['price'] }}〒</li>
              <li>
                <div class="score">
                  @foreach($product_lang->product->options as $option)
                    <?php $titles = unserialize($option->title); ?>
                    <strong>{{ $titles[$lang]['title'] }}</strong>
                  @endforeach
                </div>
              </li>
            </ul>
          </div>
        </div>
      @endforeach
    </div>

    <p class="text-center"><a href="#0" class="btn_1 rounded add_top_30">Load more</a></p>
  </div>
  
  <!-- Sign In Popup -->
  <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
      <h3>Sign In</h3>
    </div>
    <form>
      <div class="sign-in-wrapper">
        <a href="#0" class="social_bt facebook">Login with Facebook</a>
        <a href="#0" class="social_bt google">Login with Google</a>
        <div class="divider"><span>Or</span></div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" name="email" id="email">
          <i class="icon_mail_alt"></i>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password" id="password" value="">
          <i class="icon_lock_alt"></i>
        </div>
        <div class="clearfix add_bottom_15">
          <div class="checkboxes float-left">
            <label class="container_check">Remember me
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
          </div>
          <div class="float-right mt-1"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
        </div>
        <div class="text-center"><input type="submit" value="Log In" class="btn_1 full-width"></div>
        <div class="text-center">
          Don’t have an account? <a href="register.html">Sign up</a>
        </div>
        <div id="forgot_pw">
          <div class="form-group">
            <label>Please confirm login email below</label>
            <input type="email" class="form-control" name="email_forgot" id="email_forgot">
            <i class="icon_mail_alt"></i>
          </div>
          <p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
          <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
        </div>
      </div>
    </form>
    <!--form -->
  </div>

@endsection

@section('scripts')
  <!-- Isotope Filtering -->
  <script src="js/isotope.min.js"></script>
  <script>
  $(window).on('load', function(){
    var $container = $('.isotope-wrapper');
    $container.isotope({ itemSelector: '.isotope-item', layoutMode: 'masonry' });
  });

  $('.category_filter').on( 'click', 'input', 'change', function(){
    var selector = $(this).attr('data-filter');
    $('.isotope-wrapper').isotope({ filter: selector });
  });
  </script>

  <!-- Map -->
  <script src="http://maps.googleapis.com/maps/api/js"></script>
  <script src="js/markerclusterer.js"></script>
  <script src="js/map.js"></script>
  <script src="js/infobox.js"></script>
@endsection
