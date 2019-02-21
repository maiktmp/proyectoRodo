@php
    $user=Auth::user();

    $process=$process??$user->processHasUsers->process;
    $adviser=$process->hasUser()->whereFkIdRol(\App\Http\Model\Rol::ASESOR)->first();
    $reviewers=$process->hasUser()->whereFkIdRol(\App\Http\Model\Rol::REVISOR)->get();

/* @var $reviwer \App\Http\Model\ProcessHasUser*/
@endphp

@if(\App\Http\Model\User::isAdmin())
@section('backButton')
    <a href="{{route('admin_index')}}">
        <i class="fas fa-angle-left text-white" style="font-size: 1.5em"></i>
    </a>
@endsection
@endif

@if(\App\Http\Model\User::isTeacher())
@section('backButton')
    <a href="{{route('teachers_index')}}">
        <i class="fas fa-angle-left text-white" style="font-size: 1.5em"></i>
    </a>
@endsection
@endif

@extends('template.main')
@section('navbarTitle', 'Procesos')
@section('title', 'Procesos activos')
@push('scripts')
    <script type="text/javascript" charset="utf8" src="{{asset('js/student.js')}}"></script>
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10 text-center">
                                Detalles del proceso
                            </div>
                            @if(\App\Http\Model\User::isAdmin())
                                <div class="col">
                                    <a data-toggle="tooltip"
                                       data-placement="top"
                                       title="Usuarios Sancionados"
                                       href="{{route('teachers_status',['processId'=>$process->id])}}">
                                        <i class="fas fa-user-slash" style="font-size: 1.5em"></i>
                                    </a>
                                </div>
                                <div class="col">
                                    <a data-toggle="tooltip"
                                       data-placement="top"
                                       title="Administrar docentes"
                                       href="{{route('update_process',['processId'=>$process->id])}}">
                                        <i class="fas fa-users-cog" style="font-size: 1.5em"></i>
                                    </a>
                                </div>
                                <div class="col">
                                    <a data-toggle="tooltip"
                                       data-placement="top"
                                       title="Parametros del proceso"
                                       href="{{route('config_parameters',['processId'=>$process->id])}}">
                                        <i class="fas fa-cogs"></i>
                                    </a>
                                </div>
                            @elseif(\App\Http\Model\User::isStudent() && $process->state->id === \App\Http\Model\State::EN_CORRECCION )
                                <a data-toggle="tooltip"
                                   data-placement="top"
                                   title="Subir una nueva versión"
                                   href="{{route('student_revision')}}">
                                    <i class="far fa-plus-square fa-2x" style="font-size: 1.5em"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>
                                <b>Fcha de
                                    Inicio:</b> {{\App\Services\DateFormatterService::fullDate($process->begin_date)}}
                            </li>
                            <li>
                                <b>Estatus:</b> {{$process->state->name}}
                            </li>
                            <li>
                                <b>Asesor:</b> {{$adviser===null?'Sin Asignar':$adviser->user->full_name}}
                            </li>
                            <li>
                                @if($reviewers->count()>0)
                                    <dt><b>Revisores:</b></dt>
                                    <ul>
                                        @foreach($reviewers as $reviwer)
                                            <li>{{$reviwer->user->full_name}}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <b>Revisores:</b> Sin Asignar
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-2">
                <table id="table" class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Fecha de creación</th>
                        <th scope="col">Fecha límite de revisión</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($process
                            ->hasUser()
                            ->where('fk_id_rol',\App\Http\Model\Rol::ESTUDIANTE)
                            ->first()
                            ->user
                            ->documents as $document)
                        <tr class="clickable-row cursor-pointer"
                            data-href='{{route('student_document',['documentId'=>$document->id])}}'>
                            <th scope="col">{{$loop->iteration}}</th>
                            <td>{{$document->status->name}}</td>
                            <td>{{\App\Services\DateFormatterService::fullDatetime($document->created_at)}}</td>
                            <td>
                                <ul>
                                    @foreach($reviewers as $reviwer)
                                        <li>{{$reviwer->user->full_name}}
                                            : {{\App\Services\DateFormatterService::fullDate($reviwer->delivery_date)}}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection