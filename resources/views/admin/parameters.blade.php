@php
    /* @var  $alumno \App\Http\Model\User*/
@endphp
@extends('template.main')
@section('title', 'Revisiones')
@section('navbarTitle', 'Revisiones')
@section('backButton')
    <a href="{{route('get_process',['processId'=>$processId])}}">
        <i class="fas fa-angle-left text-white" style="font-size: 1.5em"></i>
    </a>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 offset-4">
                <div class="card my-3">
                    <div class="card-header text-center bg-primary">
                        <h3 class="text-white">Parámetros del proceso</h3>
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

                        </div>
                        {!! Form::open([
                        'files'=>'true'
                          ])!!}
                        <div class="row">
                            <div class="col-12 text-left">
                                @include('components.form.text_group', [
                                      'name' => 'name',
                                      'label' => 'Nombre del proyecto',
                                      'errors' => $errors,
                                      'errorName' => 'name',
                                      'value'=>\App\Http\Model\Process::find($processId)->name
                                  ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-left">
                                @include('components.form.text_group', [
                                      'name' => 'product',
                                      'label' => 'Producto',
                                      'errors' => $errors,
                                      'errorName' => 'product',
                                      'value'=>\App\Http\Model\Process::find($processId)->producto
                                  ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <button class="btn btn-primary" type="submit">Asignar</button>
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

@endpush