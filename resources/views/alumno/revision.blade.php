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
                        <h3 class="text-white">Revisión {{isset($document)?:'1'}}</h3>
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
                        <div class="row">
                            <div class="col">
                                <div class="alert alert-primary text-center" role="alert">
                                    Alumno: {{$alumno->full_name}}
                                </div>
                            </div>
                        </div>
                        {!! Form::open([
                        'files'=>'true'
                          ])!!}
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
        });
    </script>
@endpush