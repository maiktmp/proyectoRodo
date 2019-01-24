@php
    $user=Auth::user();
    $process=$user->processHasUsers->process;
    $adviser=$user->processHasUsers()->whereFkIdRol(\App\Http\Model\Rol::ASESOR)->first();
    $reviewers=$user->processHasUsers()->whereFkIdRol(\App\Http\Model\Rol::REVISOR)->get();
/* @var $reviwer \App\Http\Model\ProcessHasUser*/
@endphp

@extends('template.main')
@section('navbarTitle', 'Procesos')
@section('title', 'Procesos activos')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 text-center">
                                Detalles del proceso
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>
                                <b>Fcha de
                                    Inicio:</b> {{\App\Services\DateFormatterService::fullDate($process->begin_date)}}
                            </li>
                            <li>
                                <b>Estatus:</b> {{$process->hasState()->latest()->first()->name}}
                            </li>
                            <li>
                                <b>Asesor:</b> {{$adviser===null?'Sin Asignar':$adviser->user->full_name}}
                            </li>
                            <li>
                                @if($reviewers->count()>0)
                                    <dt><b>Revisores:</b></dt>
                                    <dl>
                                        @foreach($reviewers as $reviwer)
                                            <dd>*{{$reviwer->user->full_name}}</dd>
                                        @endforeach
                                    </dl>
                                @else
                                    <b>Revisores:</b> Sin Asignar
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Fecha de creación</th>
                        <th scope="col">Fecha límite de revisión</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($user->documents as $document)
                        <tr>
                            <th scope="col">{{$loop->iteration}}</th>
                            <td>{{$document->status->name}}</td>
                            <td>{{\App\Services\DateFormatterService::fullDatetime($document->created_at)}}</td>
                            <td>{{\App\Services\DateFormatterService::fullDatetime($document->delivery_date)}}</td>
                        </tr>
                    @empty

                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection