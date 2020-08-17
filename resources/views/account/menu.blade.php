  <div class="box_style_cat">
    <ul id="cat_nav">
      <li><a @if (Request::is($lang.'/my-profile')) class="active" @endif href="/{{ $lang }}/my-profile">Мой профиль</a></li>
      <li><a @if (Request::is($lang.'/my-companies')) class="active" @endif href="/{{ $lang }}/my-companies">Мои компании</a></li>
      <li><a @if (Request::is($lang.'/my-ads')) class="active" @endif href="/{{ $lang }}/my-ads">Мои объявления</a></li>
      <li><a @if (Request::is($lang.'/my-orders')) class="active" @endif href="/{{ $lang }}/my-orders">Мои заказы</a></li>
      <li><a @if (Request::is($lang.'/statistics')) class="active" @endif href="/{{ $lang }}/statistics">Статистика</a></li>
      <li><a href="/{{ $lang }}/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход</a></li>
      <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display: none;">
        @csrf
      </form>
    </ul>
  </div>
