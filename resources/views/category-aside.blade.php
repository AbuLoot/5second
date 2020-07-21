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
        <div class="col-lg-3 col-md-4 col-10">
          <h4><strong>145</strong> result for {{ $category->title }}</h4>
        </div>
        <div class="col-lg-9 col-md-8 col-2">
          <a href="#0" class="side_panel btn_search_mobile"></a> <!-- /open search panel -->
          <div class="row no-gutters custom-search-input-2 inner">
            <div class="col-lg-4">
              <div class="form-group">
                <input class="form-control" type="text" placeholder="What are you looking for...">
                <i class="icon_search"></i>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <input class="form-control" type="text" placeholder="Where">
                <i class="icon_pin_alt"></i>
              </div>
            </div>
            <div class="col-lg-3">
              <select class="wide">
                <option>All Categories</option> 
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

  <div class="filters_listing version_2  sticky_horizontal-">
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

  <!-- Map -->
  <div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
  </div>

  <div class="container margin_60_35">
    <div class="row">
      <aside class="col-lg-3" id="sidebar">
        <div id="filters_col">
          <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters </a>
          <div class="collapse show" id="collapseFilters">
            <div class="filter_type">
              <h6>Category</h6>
              <ul>
                <li>
                  <label class="container_check">Restaurants <small>245</small>
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </li>
                <li>
                  <label class="container_check">Shops <small>67</small>
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </li>
                <li>
                  <label class="container_check">Bars <small>32</small>
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </li>
                <li>
                  <label class="container_check">Events <small>89</small>
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </li>
              </ul>
            </div>
            <div class="filter_type">
              <h6>Distance</h6>
              <div class="distance"> Radius around selected destination <span></span> km</div>
              <input type="range" min="10" max="100" step="10" value="30" data-orientation="horizontal">
            </div>
            <div class="filter_type">
              <h6>Rating</h6>
              <ul>
                <li>
                  <label class="container_check">Superb 9+ <small>43</small>
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </li>
                <li>
                  <label class="container_check">Very Good 8+ <small>15</small>
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </li>
                <li>
                  <label class="container_check">Good 7+ <small>56</small>
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </li>
                <li>
                  <label class="container_check">Pleasant 6+ <small>23</small>
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </li>
              </ul>
            </div>
          </div>
          <!--/collapse -->
        </div>
        <!--/filters col-->
      </aside>
      <!-- /aside -->

      <div class="col-lg-9">
        <div class="row">
          <div class="col-md-6">
            <div class="strip grid">
              <figure>
                <a href="#0" class="wish_bt"></a>
                <a href="detail-restaurant.html"><img src="img/location_1.jpg" class="img-fluid" alt="">
                  <div class="read_more"><span>Read more</span></div>
                </a>
                <small>Restaurant</small>
              </figure>
              <div class="wrapper">
                <h3><a href="detail-restaurant.html">Da Alfredo</a></h3>
                <small>27 Old Gloucester St</small>
                <p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu.</p>
                <a class="address" href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x47e66e1de36f4147:0xb6615b4092e0351f!2sAssistance+Publique+-+H%C3%B4pitaux+de+Paris+(AP-HP)+-+Si%C3%A8ge!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361">Get directions</a>
              </div>
              <ul>
                <li><span class="loc_open">Now Open</span></li>
                <li>
                  <div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div>
                </li>
              </ul>
            </div>
          </div>
          <!-- /strip grid -->
          <div class="col-md-6">
            <div class="strip grid">
              <figure>
                <a href="#0" class="wish_bt"></a>
                <a href="detail-restaurant.html"><img src="img/location_2.jpg" class="img-fluid" alt="">
                  <div class="read_more"><span>Read more</span></div>
                </a>
                <small>Bar</small>
              </figure>
              <div class="wrapper">
                <h3><a href="detail-restaurant.html">Limon Bar</a></h3>
                <small>438 Rush Green Road, Romford</small>
                <p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu.</p>
                <a class="address" href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x47e66e1de36f4147:0xb6615b4092e0351f!2sAssistance+Publique+-+H%C3%B4pitaux+de+Paris+(AP-HP)+-+Si%C3%A8ge!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361">Get directions</a>
              </div>
              <ul>
                <li><span class="loc_open">Now Open</span></li>
                <li>
                  <div class="score"><span>Good<em>350 Reviews</em></span><strong>7.0</strong></div>
                </li>
              </ul>
            </div>
          </div>
          <!-- /strip grid -->
          <div class="col-md-6">
            <div class="strip grid">
              <figure>
                <a href="#0" class="wish_bt"></a>
                <a href="detail-shop.html"><img src="img/location_3.jpg" class="img-fluid" alt="">
                  <div class="read_more"><span>Read more</span></div>
                </a>
                <small>Shop</small>
              </figure>
              <div class="wrapper">
                <h3><a href="detail-shop.html">Mary Boutique</a></h3>
                <small>43 Stephen Road, Bexleyheath</small>
                <p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu.</p>
                <a class="address" href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x47e66e1de36f4147:0xb6615b4092e0351f!2sAssistance+Publique+-+H%C3%B4pitaux+de+Paris+(AP-HP)+-+Si%C3%A8ge!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361">Get directions</a>
              </div>
              <ul>
                <li><span class="loc_closed">Now Closed</span></li>
                <li>
                  <div class="score"><span>Good<em>350 Reviews</em></span><strong>7.0</strong></div>
                </li>
              </ul>
            </div>
          </div>
          <!-- /strip grid -->
          <div class="col-md-6">
            <div class="strip grid">
              <figure>
                <a href="#0" class="wish_bt"></a>
                <a href="detail-restaurant.html"><img src="img/location_4.jpg" class="img-fluid" alt="">
                  <div class="read_more"><span>Read more</span></div>
                </a>
                <small>Bar</small>
              </figure>
              <div class="wrapper">
                <h3><a href="detail-restaurant.html">Garden Bar</a></h3>
                <small>40 Beechwood Road, Sanderstead</small>
                <p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu.</p>
                <a class="address" href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x47e66e1de36f4147:0xb6615b4092e0351f!2sAssistance+Publique+-+H%C3%B4pitaux+de+Paris+(AP-HP)+-+Si%C3%A8ge!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361">Get directions</a>
              </div>
              <ul>
                <li><span class="loc_closed">Now Closed</span></li>
                <li>
                  <div class="score"><span>Superb<em>350 Reviews</em></span><strong>9.0</strong></div>
                </li>
              </ul>
            </div>
          </div>
          <!-- /strip grid -->
          <div class="col-md-6">
            <div class="strip grid">
              <figure>
                <a href="#0" class="wish_bt"></a>
                <a href="detail-hotel.html"><img src="img/location_5.jpg" class="img-fluid" alt="">
                  <div class="read_more"><span>Read more</span></div>
                </a>
                <small>Hotel</small>
              </figure>
              <div class="wrapper">
                <h3><a href="detail-hotel.html">Mariott Hotel</a></h3>
                <small>213 Malden Road, New Malden</small>
                <p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu.</p>
                <a class="address" href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x47e66e1de36f4147:0xb6615b4092e0351f!2sAssistance+Publique+-+H%C3%B4pitaux+de+Paris+(AP-HP)+-+Si%C3%A8ge!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361">Get directions</a>
              </div>
              <ul>
                <li><span class="loc_open">Now Open</span></li>
                <li>
                  <div class="score"><span>Good<em>350 Reviews</em></span><strong>7.5</strong></div>
                </li>
              </ul>
            </div>
          </div>
          <!-- /strip grid -->
          <div class="col-md-6">
            <div class="strip grid">
              <figure>
                <a href="#0" class="wish_bt"></a>
                <a href="detail-restaurant.html"><img src="img/location_6.jpg" class="img-fluid" alt="">
                  <div class="read_more"><span>Read more</span></div>
                </a>
                <small>Event</small>
              </figure>
              <div class="wrapper">
                <h3><a href="detail-restaurant.html">Six Pistols</a></h3>
                <small>Coverdale Road, Willesden</small>
                <p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu.</p>
                <a class="address" href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x47e66e1de36f4147:0xb6615b4092e0351f!2sAssistance+Publique+-+H%C3%B4pitaux+de+Paris+(AP-HP)+-+Si%C3%A8ge!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361">Get directions</a>
              </div>
              <ul>
                <li><span class="loc_open">Now Open</span></li>
                <li>
                  <div class="score"><span>Good<em>350 Reviews</em></span><strong>7.8</strong></div>
                </li>
              </ul>
            </div>
          </div>
          <!-- /strip grid -->
        </div>
        <!-- /row -->

        <p class="text-center"><a href="#0" class="btn_1 rounded add_top_30">Load more</a></p>
      </div>
      <!-- /col -->
    </div>    
  </div>
  <!-- /container -->

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

  <!-- Map -->
  <script src="http://maps.googleapis.com/maps/api/js"></script>
  <script src="js/markerclusterer.js"></script>
  <script src="js/map.js"></script>
  <script src="js/infobox.js"></script>

@endsection
