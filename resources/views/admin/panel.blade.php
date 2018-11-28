@php
    /* @var  $proceso \App\Http\Model\Proceso*/

$procesosSinAsignar=\App\Http\Model\Proceso::whereEstado('Sin asignar')->get();
@endphp
@extends('template.main')
@section('navbarTitle', 'Titulación')
@section('title', 'Proyectos')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2 mt-3 pr-0">
                <div class="nav flex-column nav-pills list-group" role="tablist" aria-orientation="vertical">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">Sin asignar</a>
                        <a href="#" class="list-group-item list-group-item-action">Retrasos</a>
                        <a href="#" class="list-group-item list-group-item-action">En correción</a>
                        <a href="#" class="list-group-item list-group-item-action">En revisión</a>
                        <a href="#" class="list-group-item list-group-item-action disabled">Concluidos</a>
                    </div>
                </div>
            </div>
            <div class="col mt-3 ml-0 pl-0">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center" scope="col">Id proceso</th>
                                <th class="text-center" scope="col">Alumno</th>
                                <th class="text-center" scope="col">Fecha</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($procesosSinAsignar as $proceso)
                                <tr>
                                    <td class="text-center">#{{$proceso->id}}</td>
                                    <td class="text-center">{{
                                    $proceso->alumno->nombre .' '.
                                    $proceso->alumno->apellidoP.' '.
                                    $proceso->alumno->apellidoM
                                    }}</td>
                                    <td class="text-center">{{$proceso->created_at->format('Y-m-d')}}</td>
                                    <td class="text-center">
                                        <a data-toggle="tooltip"
                                           title="Ver detalles"
                                           href="{{
                                           route('get_process',['processId'=>$proceso->id])
                                           }}">
                                            <i class="far fa-eye font-size-1_5"></i>
                                        </a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush