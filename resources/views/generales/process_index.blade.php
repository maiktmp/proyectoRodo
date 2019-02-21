@php
    /* @var $processIter \App\Http\Model\Process */
@endphp
@extends('template.main')
@section('navbarTitle', 'Procesos activos')
@section('title', 'Titulación')
@section('content')
    <div class="container">
        <div class="row my-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                     aria-orientation="vertical">
                                    <a class="nav-link nav-lateral active"
                                       id="v-pills-home-tab"
                                       data-toggle="pill"
                                       href="#v-pills-home"
                                       role="tab"
                                       aria-controls="v-pills-home"
                                       aria-selected="true">Sin asignar</a>
                                    <a class="nav-link nav-lateral"
                                       id="v-pills-profile-tab"
                                       data-toggle="pill"
                                       href="#v-pills-profile"
                                       role="tab"
                                       aria-controls="v-pills-profile"
                                       aria-selected="false">Pendiente de aceptar por revisor</a>
                                    <a class="nav-link nav-lateral"
                                       id="v-pills-messages-tab"
                                       data-toggle="pill"
                                       href="#v-pills-messages"
                                       role="tab" se
                                       aria-controls="v-pills-messages"
                                       aria-selected="false">En revisión</a>
                                    <a class="nav-link nav-lateral"
                                       id="v-pills-settings-tab"
                                       data-toggle="pill"
                                       href="#v-pills-settings"
                                       role="tab"
                                       aria-controls="v-pills-settings"
                                       aria-selected="false">En corrección</a>
                                    <a class="nav-link nav-lateral"
                                       id="v-pills-settings-retard-tab"
                                       data-toggle="pill"
                                       href="#v-pills-settings-retard"
                                       role="tab"
                                       aria-controls="v-pills-settings-retard"
                                       aria-selected="false">Retrasado</a>
                                    <a class="nav-link nav-lateral"
                                       id="v-pills-settings-end-tab"
                                       data-toggle="pill"
                                       href="#v-pills-settings-end"
                                       role="tab"
                                       aria-controls="v-pills-settings-end"
                                       aria-selected="false">Concluido</a>
                                    <a class="nav-link nav-lateral"
                                       href="{{route('teachers_status',['processId'=>0])}}"
                                       aria-selected="false">Sancionados</a>
                                </div>

                            </div>

                            <div class="col">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                         aria-labelledby="v-pills-home-tab">
                                        @include('generales._table_process',['process'=>\App\Http\Model\Process::firstFilter()])

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                         aria-labelledby="v-pills-profile-tab">
                                        @include('generales._table_process',['process'=>\App\Http\Model\Process::secondFilter()])

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                         aria-labelledby="v-pills-messages-tab">
                                        @include('generales._table_process',['process'=>\App\Http\Model\Process::thirdFilter()])

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                         aria-labelledby="v-pills-settings-tab">
                                        @include('generales._table_process',['process'=>\App\Http\Model\Process::fourthFilter()])

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-settings-retard" role="tabpanel"
                                         aria-labelledby="v-pills-settings-retard-tab">
                                        @include('generales._table_process',['process'=>\App\Http\Model\Process::fifthFilter()])
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-settings-end" role="tabpanel"
                                         aria-labelledby="v-pills-settings-end-tab">
                                        @include('generales._table_process',[
                                        'process'=>\App\Http\Model\Process::sixtFilter(),
                                        'pdf'=>true
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
