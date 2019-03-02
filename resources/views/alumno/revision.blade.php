@php
    /* @var  $alumno \App\Http\Model\User*/
@endphp
@extends('template.main')
@section('title', 'Revisiones')
@section('navbarTitle', 'Revisiones')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card my-3">
                    <div class="card-header text-center bg-primary">
                        <h3 class="text-white">Revisión {{Auth::user()->documents()->count()+1}}</h3>
                    </div>
                    <div class="row">
                        @if ($errors->has('general'))
                            <div class="col">
                                <div class="alert alert-danger">
                                    <p>{{ $errors->first('general') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        {!! Form::open([
                        'files'=>'true'
                          ])!!}
                        @if(Auth::user()->documents()->count()===0)
                            <div class="row">
                                <div class="col-8 offset-2 text-left">
                                    @include('components.form.text_group', [
                                          'name' => 'name',
                                          'label' => 'Nombre del proyecto',
                                          'errors' => $errors,
                                          'errorName' => 'name'
                                      ])
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8 offset-2 text-left">
                                    <div class="form-group">
                                        <label for="producto" class="">Opción de titulación
                                            <i id="tooltip"
                                               data-container="body"
                                               data-toggle="popover"
                                               data-placement="top"

                                               class=" cursor-pointer fas fa-question-circle"></i>
                                        </label>
                                        <input class="form-control {{$errors->has("producto")? 'is-invalid': ''}}"
                                               name="producto"
                                               type="text">
                                        <div class="invalid-feedback">
                                            {{ $errors->first("producto") }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8 offset-2 text-left">
                                    @include('components.form.select_group', [
                                          'name' => 'fk_id_user',
                                          'label' => 'Asesor',
                                          'options'=>\App\Http\Model\User::getTeachers(),
                                          'errors' => $errors,
                                          'errorName' => 'fk_id_user'
                                      ])
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
                        @endif
                        <div class="row mt-2">
                            <div class="col-8 offset-2 text-left">
                                @include('components.form.file_group', [
                                      'name' => 'url',
                                      'label' => 'Documento',
                                      'labelClass' => 'lbl-doc',
                                      'errors' => $errors,
                                      'errorName' => 'url'
                                  ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8 offset-2 text-left">
                                @include('components.form.textarea_group', [
                                      'name' => 'comments',
                                      'label' => 'Comentarios',
                                      'rows'=>5,
                                      'errors' => $errors,
                                      'errorName' => 'comments'
                                  ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <button class="btn btn-primary" type="submit">Enviar documento al asesor</button>
                            </div>
                        </div>
                        {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('input[type="file"]').change(function (e) {
                var fileName = e.target.files[0].name;
                $('.lbl-doc').html(fileName);
            });
            var on = false;
            $('#tooltip').hover(function () {
                $('#tooltip').popover({
                    content: '<ul>' +
                        '<li>PROYECTO</li>' +
                        '<li>INFORME TÉCNICO DE RESIDENCIA PROFESIONAL</li>' +
                        '<li>TESIS</li>' +
                        '<li>OTRO (ESPECIFIQUE)</li>' +
                        '</ul>',
                    html: true
                });
                on = !on;
                if (on) {
                    $(this).popover("show");
                } else {
                    $(this).popover("hide");
                }
            });
        });
    </script>
@endpush