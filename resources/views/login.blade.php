@php
        @endphp
@extends('template.main')
@section('title', 'Login')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card my-3">
                    <div class="card-header text-center bg-primary">
                        <h4 class="text-white">Inicio de sesión</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::open([
                         'route'=>['login_auth']
                          ])!!}
                        <div class="row mt-2">
                            <div class="col-8 offset-2 text-center">
                                @include('components.form.text_group', [
                                      'name' => 'username',
                                      'label' => 'Usuario',
                                      'labelClass' => 'text-bold',
                                      'errors' => $errors,
                                      'errorName' => 'username'
                                  ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8 offset-2 text-center">
                                @include('components.form.password_group', [
                                    'update'=>false,
                                      'name' => 'password',
                                      'label' => 'Contraseña',
                                      'labelClass' => 'text-bold',
                                      'errors' => $errors,
                                      'errorName' => 'password'
                                  ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <button class="btn btn-primary" type="submit">Entrar</button>
                            </div>
                        </div>
                        {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection