@php
    /* @var $document \App\Http\Model\Document */
    /* @var $processHasDocument \App\Http\Model\ProcessHasDocument */
@endphp

@section('backButton')
    @if(Auth::user()->userType->id === \App\Http\Model\UserType::ADMIN)
        <a href="{{route('get_process',['processId'=>$document->user->processHasUsers->fk_id_process])}}">
            <i class="fas fa-angle-left text-white" style="font-size: 1.5em"></i>
        </a>
    @else
        <a href="{{route('process_student')}}">
            <i class="fas fa-angle-left text-white" style="font-size: 1.5em"></i>
        </a>
    @endif
@endsection

@extends('template.main')
@section('navbarTitle', 'Revisiónes de documentos')
@section('title', 'Documento')
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
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2 my-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col text-center">
                                {{$document->user->userType->name}}: {{$document->user->full_name}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h5>Documento: </h5>
                                <a href="{{asset($document->url)}}">
                                    <i class="fas fa-file-word fa-2x"></i>
                                </a>

                            </div>
                            <div class="col-12">
                                <h4>Comentarios: </h4>
                            </div>
                            <div class="col-12 text-justify">
                                {{$document->comments}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @forelse($document->processHasDocuments as $processHasDocument)
                <div class="col-8 offset-2 my-2">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col text-center">
                                    {{$processHasDocument->processHasUser->rol->name}}
                                    : {{$processHasDocument->processHasUser->user->full_name}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-center">
                                    @if($processHasDocument->document_url!==null)
                                        <h5>Documento: </h5>
                                        <a href="{{asset($processHasDocument->document_url)}}">
                                            <i class="fas fa-file-word fa-2x"></i>
                                        </a>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <h5>Comentarios: </h5>
                                </div>
                                <div class="col-12 text-justify">
                                    {{$processHasDocument->comments}}
                                </div>
                                <div class="col-12 text-justify">
                                    <h5>Postura: {{$processHasDocument->position->name}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
            @if(\App\Http\Model\User::isTeacher())
                @if( \App\Http\Model\ProcessHasUser::whereFkIdUser(Auth::user()->id)->first()->active===1
                && \App\Http\Model\User::canReview($document->id)
                )
                    <div class="col-8 offset-2 my-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        @if($errors->has("general"))
                                            <div class="alert alert-danger">{{$errors->first("general")}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        {!! Form::open([
                                 'files'=>'true'
                                   ])!!}
                                        <div class="row mt-2">
                                            <div class="col-8 offset-2 text-left">
                                                @include('components.form.select_group', [
                                               'name' => 'fk_id_rol',
                                               'label' => 'Rol',
                                               'errors' => $errors,
                                               'errorName' => "fk_id_rol",
                                               'options'=>\App\Http\Model\Rol::asMapInProcess($document->user->processHasUsers->fk_id_rol,Auth::user()->id)
                                       ])
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-8 offset-2 text-left">
                                                @include('components.form.select_group', [
                                               'id'=>'select_position',
                                               'name' => 'fk_id_position',
                                               'label' => 'Posición',
                                               'errors' => $errors,
                                               'errorName' => "fk_id_position",
                                               'options'=>\App\Http\Model\Position::asMap()
                                       ])
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-8 offset-2 text-left">
                                                @include('components.form.file_group', [
                                                      'name' => 'doc_url',
                                                      'label' => 'Documento',
                                                      'labelClass' => 'lbl-doc',
                                                      'errors' => $errors,
                                                      'errorName' => 'doc_url'
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
                                                <button class="btn btn-primary" type="submit">Enviar revisión
                                                </button>
                                            </div>
                                        </div>
                                        {!! Form::close()!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection