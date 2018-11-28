@php
    /* @var $process \App\Http\Model\Proceso */
@endphp
@extends('template.main')
@section('navbarTitle', 'Titulación')
@section('title', 'Titulación')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    {!! Form::open() !!}
                    <div class="card-body">
                        <h4 class="text-center text-bold">Proceso #{{$process->id}}</h4>
                        <div class="col-6 offset-3">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>
                                        <b>Fecha de Inicio</b>
                                    </td>
                                    <td>
                                        {{$process->created_at->format('Y/m/d')}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Estado</b>
                                    </td>
                                    <td>
                                        {{$process->estado}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Ultimos cambios</b>
                                    </td>
                                    <td>
                                        {{$process->updated_at->format('Y/m/d')}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <h4 class="text-center text-bold">Asesores</h4>
                        <input type="hidden" id="inp-options" value="{{\App\Http\Model\Profesor::UserasMap()}}">
                        @if(isset($process->involucrados) && !isset($update))
                            @foreach($process->involucrados as $involucrados)
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h4>{{$involucrados->rol==='asesor'?$involucrados->profesor->nombre.
                                        " ".$involucrados->profesor->apellidoM.
                                        " ".$involucrados->profesor->apellidoP
                                        :''}}</h4>
                                    </div>
                                </div>
                            @endforeach
                        @endif


                        @isset($update)
                            <div class="row">
                                <div class="col-4 offset-2">
                                    <div class="text-left ">
                                        @include('components.form.select_group', [
                                        'name' => 'fk_id_profesor',
                                        'label' => 'Profesor',
                                        'labelClass' => 'color-green text-bold',
                                        'options'=>\App\Http\Model\Profesor::UserasMap(),
                                        'errors' => $errors,
                                        'errorName' => 'fk_id_profesor'
                                         ])
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-left">
                                        @include('components.form.select_group', [
                                        'name' => 'rol',
                                        'label' => 'Rol',
                                        'labelClass' => 'color-green text-bold',
                                        'id'=>'id',
                                        'options'=>[
                                                1=>'Asesor',
                                                2=>'Co asesor'
                                        ],
                                        'errors' => $errors,
                                        'errorName' => 'rol'
                                         ])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 offset-2">
                                    <div class="text-left ">
                                        @include('components.form.select_group', [
                                        'name' => 'fk_id_profesor1',
                                        'label' => 'Profesor',
                                        'labelClass' => 'color-green text-bold',
                                        'options'=>\App\Http\Model\Profesor::UserasMap(),
                                        'errors' => $errors,
                                        'errorName' => 'fk_id_profesor1'
                                         ])
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-left">
                                        @include('components.form.select_group', [
                                        'name' => 'rol1',
                                        'label' => 'Rol',
                                        'labelClass' => 'color-green text-bold',
                                        'options'=>[
                                                1=>'Asesor',
                                                2=>'Co asesor'
                                        ],
                                        'errors' => $errors,
                                        'errorName' => 'rol1'
                                         ])
                                    </div>
                                </div>
                            </div>
                        @endisset
                        <hr class="mt-3">
                        <h4 class="text-center text-bold">Revisores</h4>


                        @isset($update)
                            <div class="row">
                                <div class="col-4 offset-2">
                                    <div class="text-left ">
                                        @include('components.form.select_group', [
                                        'name' => 'fk_id_profesor3',
                                        'label' => 'Profesor',
                                        'labelClass' => 'color-green text-bold',
                                        'options'=>\App\Http\Model\Profesor::UserasMap(),
                                        'errors' => $errors,
                                        'errorName' => 'fk_id_profesor3'
                                         ])
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-left">
                                        @include('components.form.text_group', [
                                        'id'=>'date',
                                        'name' => 'fecha-limite',
                                        'label' => 'Fecha Límite',
                                        'labelClass' => 'color-green text-bold',
                                        'options'=>[
                                                1=>'Asesor',
                                                2=>'Co asesor'
                                        ],
                                        'errors' => $errors,
                                        'errorName' => 'fecha-limite'
                                         ])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 offset-2">
                                    <div class="text-left ">
                                        @include('components.form.select_group', [
                                        'name' => 'fk_id_profesor4',
                                        'label' => 'Profesor',
                                        'labelClass' => 'color-green text-bold',
                                        'options'=>\App\Http\Model\Profesor::UserasMap(),
                                        'errors' => $errors,
                                        'errorName' => 'fk_id_profesor4'
                                         ])
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-left">
                                        @include('components.form.text_group', [
                                            'id'=>'date1',
                                            'name' => 'fecha-limite1',
                                            'label' => 'Fecha Límite',
                                            'labelClass' => 'color-green text-bold',
                                            'options'=>[
                                                    1=>'Asesor',
                                                    2=>'Co asesor'
                                            ],
                                            'errors' => $errors,
                                            'errorName' => 'fecha-limite1'
                                             ])
                                    </div>
                                </div>
                            </div>
                        @endisset
                        <div class="row">
                            <div class="col-12 text-center">
                                @if(isset($process->revisionRevisor) && !isset($update))
                                    <a
                                            type="submit"
                                            class="btn btn-primary rounded"
                                            href="{{route('update_process',[
                                                'proccessId'=>$process->id
                                        ])}}">
                                        Editar
                                    </a>
                                @else
                                    <button class="btn btn-primary rounded" type="submit">Editar</button>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {!! Form::close()!!}
    </div>
    <input type="hidden" id="inp-url-get-teachers" value="{{route('get_teachers')}}">
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#date').attr('type', 'date');
            $('#date1').attr('type', 'date');
        });
    </script>
@endpush