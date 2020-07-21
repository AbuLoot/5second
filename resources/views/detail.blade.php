@extends('layout')

@section('meta_title', '')

@section('meta_description', '')

@section('head')

@endsection

@section('header-class', 'extra-header')

@section('content')
  
  <nav class="secondary_nav sticky_horizontal_2- -extra-nav" id="results">
    <div class="container">
      <ul class="clearfix">
        <li><a href="#description" class="active">Описание</a></li>
        <li><a href="#reviews">Отзывы</a></li>
        <li><a href="#sidebar">Бронирование</a></li>
      </ul>
    </div>
  </nav>

  <div class="container margin_60_35">
    <div class="row">
      <div class="col-lg-8">
        <div id="carousel_in" class="owl-carousel owl-theme add_bottom_30">
          @if ($product->images != '')
            <?php $images = unserialize($product->images); ?>
            @foreach ($images as $k => $image)
              <div class="item"><img src="/img/products/{{ $product->path.'/'.$images[$k]['image'] }}" alt="{{ $product_lang->title }}"></div>
            @endforeach
          @endif
        </div>
        <section id="description">
          <div class="detail_title_1">
            <div class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></div>
            <h1>{{ $product_lang->title }}</h1>
            <p>{{ $product->area }}</p>
          </div>

          {!! $product_lang->description !!}
          <!-- /row -->           
          <hr>
          @foreach($similar_products_lang as $similar_product_lang)
            <div class="room_type first">
              <div class="row">
                <div class="col-md-4">
                  <img src="/img/products/{{ $similar_product_lang->product->path.'/'.$similar_product_lang->product->image }}" class="img-fluid" alt="{{ $similar_product_lang->title }}">
                </div>
                <div class="col-md-8">
                  <h4><a href="/{{ $lang.'/'.Str::limit($similar_product_lang['slug'], 35).'/'.'p-'.$similar_product_lang->product->id }}">{{ $similar_product_lang->title }}</a></h4>
                  <ul class="hotel_facilities">
                    @foreach($product->options as $option)
                      <?php $titles = unserialize($option->title); ?>
                      <li>{{ $titles[$lang]['title'] }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          @endforeach
          <hr>
          <h3>Location</h3>
          <div id="map" class="map map_single add_bottom_45"></div>
        </section>
      
        <section id="reviews">
          <h2>Reviews</h2>

          <div class="reviews-container">

            <div class="review-box clearfix">
              <figure class="rev-thumb"><img src="img/avatar1.jpg" alt="">
              </figure>
              <div class="rev-content">
                <div class="rating">
                  <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                </div>
                <div class="rev-info">
                  Admin – April 03, 2016:
                </div>
                <div class="rev-text">
                  <p>
                    Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
                  </p>
                </div>
              </div>
            </div>
            <!-- /review-box -->
            <div class="review-box clearfix">
              <figure class="rev-thumb"><img src="img/avatar2.jpg" alt="">
              </figure>
              <div class="rev-content">
                <div class="rating">
                  <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                </div>
                <div class="rev-info">
                  Ahsan – April 01, 2016:
                </div>
                <div class="rev-text">
                  <p>
                    Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
                  </p>
                </div>
              </div>
            </div>
            <!-- /review-box -->
            <div class="review-box clearfix">
              <figure class="rev-thumb"><img src="img/avatar3.jpg" alt="">
              </figure>
              <div class="rev-content">
                <div class="rating">
                  <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                </div>
                <div class="rev-info">
                  Sara – March 31, 2016:
                </div>
                <div class="rev-text">
                  <p>
                    Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
                  </p>
                </div>
              </div>
            </div>
            <!-- /review-box -->
          </div>
          <!-- /review-container -->
        </section>
        <hr>

        <div class="add-review">
          <h5>Leave a Review</h5>
          <form>
            <div class="row">
              <div class="form-group col-md-6">
                <label>Name and Lastname *</label>
                <input type="text" name="name_review" id="name_review" placeholder="" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <label>Email *</label>
                <input type="email" name="email_review" id="email_review" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <label>Rating </label>
                <div class="custom-select-form">
                <select name="rating_review" id="rating_review" class="wide">
                  <option value="1">1 (lowest)</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5" selected>5 (medium)</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10 (highest)</option>
                </select>
                </div>
              </div>
              <div class="form-group col-md-12">
                <label>Your Review</label>
                <textarea name="review_text" id="review_text" class="form-control" style="height:130px;"></textarea>
              </div>
              <div class="form-group col-md-12 add_top_20 add_bottom_30">
                <input type="submit" value="Submit" class="btn_1" id="submit-review">
              </div>
            </div>
          </form>
        </div>
      </div>
      
      <aside class="col-lg-4" id="sidebar">
        <div class="box_detail booking">
          <div class="price">
            <span>От {{ $product_lang['price'] }}〒</span>
            <div class="score">
              @foreach($product->options as $option)
                <?php $titles = unserialize($option->title); ?>
                <strong>{{ $titles[$lang]['title'] }}</strong>
              @endforeach
            </div>
          </div>

          <div class="form-group" id="input-dates">
            <input class="form-control" type="text" name="dates" placeholder="When..">
            <i class="icon_calendar"></i>
          </div>

          <div class="dropdown">
            <a href="#" data-toggle="dropdown">Guests <span id="qty_total">0</span></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-menu-content">
                <label>Adults</label>
                <div class="qty-buttons">
                  <input type="button" value="+" class="qtyplus" name="adults">
                  <input type="text" name="adults" id="adults" value="0" class="qty">
                  <input type="button" value="-" class="qtyminus" name="adults">
                </div>
              </div>
              <div class="dropdown-menu-content">
                <label>Childrens</label>
                <div class="qty-buttons">
                  <input type="button" value="+" class="qtyplus" name="child">
                  <input type="text" name="child" id="child" value="0" class="qty">
                  <input type="button" value="-" class="qtyminus" name="child">
                </div>
              </div>
            </div>
          </div>
          <!-- /dropdown -->

          <div class="form-group clearfix">
            <div class="custom-select-form">
              <select class="wide">
                <option>Room Type</option>  
                <option>Single Room</option>
                <option>Double Room</option>
                <option>Suite Room</option>
              </select>
            </div>
          </div>
          <a href="checkout.html" class=" add_top_30 btn_1 full-width purchase">Purchase</a>
          <a href="wishlist.html" class="btn_1 full-width outline wishlist"><i class="icon_heart"></i> Add to wishlist</a>
        </div>
      </aside>
    </div>
  </div>

@endsection

@section('scripts')
  <!-- CAROUSEL -->
  <script>
    $('#carousel_in').owlCarousel({
      center: false,
      items:1,
      loop:false,
      margin:0
    });
  </script>
@endsection
