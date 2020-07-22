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
          </div>
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

          <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="Имя..">
          </div>

          <div class="form-group">
            <input class="form-control" type="tel" name="phone" placeholder="Телефон..">
          </div>

          <div class="form-group" id="input-dates">
            <input class="form-control" type="text" name="dates" placeholder="Дата..">
            <i class="icon_calendar"></i>
          </div>

          <a href="/" class=" add_top_30 btn_1 full-width purchase">Забронировать</a>
        </div>
      </aside>
    </div>
  </div>

@endsection

@section('scripts')
  <!-- DATEPICKER  -->
  <script>
    $('input[name="dates"]').daterangepicker({
        "singleDatePicker": true,
        "parentEl": '#input-dates',
        "opens": "left"
    }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });
  </script>

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
