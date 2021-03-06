@extends('joystick-admin.layout')


@section('content')
  <h2 class="page-header">Добавление</h2>

  @include('joystick-admin.partials.alerts')

  <p class="text-right">
    <a href="/{{ $lang }}/admin/cards" class="btn btn-primary btn-sm">Назад</a>
  </p>
  <form action="{{ route('cards.store', $lang) }}" method="post">
    {!! csrf_field() !!}
    <div class="form-group">
      <label for="title">Название</label>
      <input type="text" class="form-control" id="title" name="title" minlength="2" maxlength="80" value="{{ (old('title')) ? old('title') : '' }}" required>
    </div>
    <div class="form-group">
      <label for="slug">Slug</label>
      <input type="text" class="form-control" id="slug" name="slug" maxlength="80" value="{{ (old('slug')) ? old('slug') : '' }}">
    </div>
    <div class="form-group">
      <label for="image">Картинка</label>
      <div class="input-group">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button" data-toggle="modal" data-target="#filemanager"><i class="material-icons md-18">folder</i> Выбрать</button>
        </span>

        <input type="text" class="form-control" id="image" name="image" minlength="2" maxlength="80" value="{{ (old('image')) ? old('image') : '' }}">
      </div>

      <!-- Filemanager -->
      <div class="modal fade" id="filemanager" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Файловый менеджер</h4>
            </div>
            <div class="modal-body">
              <iframe src="<?= url($lang.'/admin/filemanager'); ?>" frameborder="0" style="width:100%;min-height:600px"></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="sort_id">Номер</label>
      <input type="text" class="form-control" id="sort_id" name="sort_id" maxlength="5" value="{{ (old('sort_id')) ? old('sort_id') : NULL }}">
    </div>
    <div class="form-group">
      <label for="price">Цена</label>
      <input type="text" class="form-control" id="price" name="price" maxlength="5" value="{{ (old('price')) ? old('price') : NULL }}">
    </div>
    <div class="form-group">
      <label for="user_number">Лимит пользователей</label>
      <input type="text" class="form-control" id="user_number" name="user_number" maxlength="5" value="{{ (old('user_number')) ? old('user_number') : NULL }}">
    </div>
    <div class="form-group">
      <label for="service_number">Лимит услуг</label>
      <input type="text" class="form-control" id="service_number" name="service_number" maxlength="5" value="{{ (old('service_number')) ? old('service_number') : NULL }}">
    </div>
    <div class="form-group">
      <label for="meta_title">Мета название</label>
      <input type="text" class="form-control" id="meta_title" name="meta_title" maxlength="255" value="{{ (old('meta_title')) ? old('meta_title') : '' }}">
    </div>
    <div class="form-group">
      <label for="meta_description">Мета описание</label>
      <input type="text" class="form-control" id="meta_description" name="meta_description" maxlength="255" value="{{ (old('meta_description')) ? old('meta_description') : '' }}">
    </div>
    <div class="form-group">
      <label for="content">Контент</label>
      <textarea class="form-control" id="summernote2" name="content" rows="7" cols="10">{{ (old('content')) ? old('content') : '' }}</textarea>
    </div>
    <div class="form-group">
      <label for="lang">Язык</label>
      <select id="lang" name="lang" class="form-control" required>
        @foreach($languages as $language)
          @if (old('lang') == $language->slug)
            <option value="{{ $language->slug }}" selected>{{ $language->title }}</option>
          @else
            <option value="{{ $language->slug }}">{{ $language->title }}</option>
          @endif
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="status">Статус:</label>
      <label>
        <input type="checkbox" id="status" name="status" checked> Активен
      </label>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Создать</button>
    </div>
  </form>
@endsection

@section('head')
  <script src='//cdn.tinymce.com/4.9/tinymce.min.js'></script>
  <script>
    tinymce.init({
      selector: 'textarea',
      height: 400,
      theme: 'modern',
      plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
      toolbar1: 'code undo redo | formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
      image_advtab: true,
      templates: [
        { title: 'Test template 1', content: 'Test 1' },
        { title: 'Test template 2', content: 'Test 2' }
      ],
      content_css: [
        // '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        // '//www.tinymce.com/css/codepen.min.css'
      ]
     });
  </script>
@endsection

@section('scripts')

@endsection