@php
    /* @var $processIter \App\Http\Model\Process */
@endphp
@extends('template.main')
@section('navbarTitle', 'Procesos activos')
@section('title', 'Titulación')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="col-12 mt-2">
                    <table id="table" class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Alumno</th>
                            <th scope="col">Estatus</th>
                            <th scope="col">Asesores</th>
                            <th scope="col">Revisores</th>
                            <th scope="col">Fecha de inicio</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($process as $processIter)
                            <tr class="clickable-row" data-href='{{route('get_process',['processId'=>$processIter->id])}}'>
                                    <th scope="col">{{$loop->iteration}}</th>
                                    <th scope="col">{{
                                $processIter->hasUser()->whereFkIdRol(\App\Http\Model\Rol::ESTUDIANTE)->first()->user->full_name
                                }}</th>
                                    <th scope="col">{{$processIter->hasState()->latest()->first()->name}}</th>
                                    <th scope="col">
                                        <ul>
                                            @forelse( $processIter->hasUser()->whereFkIdRol(\App\Http\Model\Rol::ASESOR)->get() as $reviwer)
                                                <li>{{$reviwer->user->fullname}}</li>
                                            @empty
                                                <li>Sin asignar</li>
                                            @endforelse
                                        </ul>
                                    </th>
                                    <th scope="col">
                                        <ul>
                                            @forelse( $processIter->hasUser()->whereFkIdRol(\App\Http\Model\Rol::REVISOR)->get() as $reviwer)
                                                <li>{{$reviwer->user->fullname}}</li>
                                            @empty
                                                <li>Sin asignar</li>
                                            @endforelse
                                        </ul>
                                    </th>
                                    <th scope="col">{{\App\Services\DateFormatterService::fullDate($processIter->begin_date)}}</th>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
