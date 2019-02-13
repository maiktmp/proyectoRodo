@php
    /* @var  $users \App\Http\Model\ProcessHasUser[]*/
@endphp
@extends('template.main')
@section('navbarTitle', 'Titulación')
@section('title', 'Proyectos')
@section('backButton')
    @if($processId !== "0")
        <a href="{{route('get_process',['processId'=>$processId])}}">
            <i class="fas fa-angle-left text-white" style="font-size: 1.5em"></i>
        </a>
    @else
        <a href="{{route('admin_index')}}">
            <i class="fas fa-angle-left text-white" style="font-size: 1.5em"></i>
        </a>
    @endif
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2 mt-2">
                <div class="card">
                    <div class="row">
                        <div class="col">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Docente</th>
                                    <th>Rol</th>
                                    <th>Alumno involucrado</th>
                                    <th>Última versión del alumno</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{$user->user->getFullNameAttribute()}}</td>
                                        <td>{{$user->rol->name}}</td>
                                        <td>{{$user->process->getStudent()->user->getFullNameAttribute()}}</td>
                                        <td class="text-center"><a
                                                    href="{{asset($user->process->getStudent()->user->documents->last()->url)}}">
                                                <i class="fas fa-file-word fa-2x"></i>
                                            </a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Sin registros</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
