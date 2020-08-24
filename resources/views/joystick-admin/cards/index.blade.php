@extends('joystick-admin.layout')

@section('content')
  <h2 class="page-header">Карты</h2>

  <p class="text-right">
    <a href="/{{ $lang }}/admin/cards/create" class="btn btn-success btn-sm">Добавить</a>
  </p>

  @include('joystick-admin.partials.alerts')

  <div class="table-responsive">
    <table class="table table-striped table-condensed">
      <thead>
        <tr class="active">
          <td>Картинка</td>
          <td>Название</td>
          <td>Slug</td>
          <td>Цена</td>
          <td>Лимит пользователей</td>
          <td>Лимит услуг</td>
          <td>Номер</td>
          <td>Язык</td>
          <td>Статус</td>
          <td class="text-right">Функции</td>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        @foreach ($cards as $card)
          <tr>
            <td><img src="/img/{{ $card->image }}" class="img-responsive" style="width:250px;height:auto;"></td>
            <td>{{ $card->title }}</td>
            <td>{{ $card->slug }}</td>
            <td>{{ $card->price }}</td>
            <td>{{ $card->user_number }}</td>
            <td>{{ $card->service_number }}</td>
            <td>{{ $card->sort_id }}</td>
            <td>{{ $card->lang }}</td>
            @if ($card->status == 1)
              <td class="text-success">Активен</td>
            @else
              <td class="text-danger">Неактивен</td>
            @endif
            <td class="text-right text-nowrap">
              <a class="btn btn-link btn-xs" href="/{{ app()->getLocale() }}/admin/cards/{{ $card->id }}/edit" title="Редактировать"><i class="material-icons md-18">mode_edit</i></a>
              <form class="btn-delete" method="POST" action="/{{ app()->getLocale() }}/admin/cards/{{ $card->id }}" accept-charset="UTF-8">
                <input name="_method" type="hidden" value="DELETE">
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-link btn-xs" onclick="return confirm('Удалить запись?')"><i class="material-icons md-18">clear</i></button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection