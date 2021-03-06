
  @foreach($products as $product)
    <?php $product_lang = $product->products_lang->where('lang', $lang)->first(); ?>
    <div class="col-xl-4 col-lg-6 col-md-6">
      <div class="strip grid">
        <figure>
          <a href="/{{ $lang.'/'.Str::limit($product_lang['slug'], 35).'/'.'p-'.$product->id }}"><img src="/img/products/{{ $product->path.'/'.$product->image }}" class="img-fluid" alt="{{ $product_lang['title'] }}">
            <div class="read_more"><span>Подробнее</span></div>
          </a>
          @foreach($product->options as $option)
            <?php $titles = unserialize($option->title); ?>
            <small>{{ $titles[$lang]['title'] }}</small>
          @endforeach
        </figure>
        <div class="wrapper">
          <h6><a href="/{{ $lang.'/'.Str::limit($product_lang['slug'], 35).'/'.'p-'.$product->id }}">{{ $product_lang['title'] }}</a></h6>
          <small class="mb-0">{{ $product->area }}</small>
        </div>
      </div>
    </div>
  @endforeach