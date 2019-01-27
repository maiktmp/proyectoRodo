@php
    /* @var $process \App\Http\Model\Process  */
@endphp

@extends('template.main')
@section('navbarTitle', 'Editar Proceso')
@section('title', 'Configuración de procesos')
@push('scripts')
    <script src="{{ asset('commons/lib/jquery.autocomplete.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('js/process.js')}}"></script>
@endpush
@section('content')
    <div class="container">
        <input id="inp-users" type="hidden" value="{{route('update_teachers')}}">
        <div class="row my-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {!!Form::open() !!}
                        <div class="row">
                            <div class="col-4">
                                @include('components.form.text_group', [
                                'id' => 'inp-autocomplete',
                                'name' => 'fk_id_user_autocomplete',
                                'label' => 'Nombre del docente',
                                'errors' => $errors,
                                'errorName' => 'fk_id_user',
                                'value'=> old('fk_id_user_autocomplete')
                            ])
                                <input id="fk_id_user" type="hidden" name="fk_id_user" value="{{old('fk_id_user')}}">
                            </div>
                            <div class="col-3">
                                @include('components.form.select_group', [
                                      'id'=>'select_rol',
                                      'name' => 'fk_id_rol',
                                      'label' => 'Rol',
                                      'errors' => $errors,
                                      'errorName' => "fk_id_rol",
                                      'options'=>\App\Http\Model\Rol::asMap()
                              ])
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="deliveryDate">Fecha de entrega</label>
                                    <input
                                            id="deliveryDate"
                                            type="date"
                                            name="delivery_date"
                                            class="form-control {{$errors->has('delivery_date')? 'is-invalid': ''}}">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('delivery_date') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 mt-4">
                                <button type="submit" class="btn btn-light">
                                    <i id="btn-dynamic" class="fas fa-plus-circle fa-2x text-primary mt-2"></i>
                                </button>
                                <button id="btn-dynamic-cancel" type="button" class="btn btn-light" hidden="true">
                                    <i class="fas fa-times fa-2x text-danger mt-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!!Form::close() !!}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col text-center">
                                Docentes involucrados
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Docente</th>
                                        <th scope="col">Rol</th>
                                        <th scope="col">Fecha de entrega</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($process
                                            ->hasUser()
                                            ->where('fk_id_rol','<>',\App\Http\Model\Rol::ESTUDIANTE)
                                             ->get() as $processHasUser)
                                        <tr id="tr-process-user-{{$processHasUser->id}}">
                                            <td id="td-process-user-{{$processHasUser->id}}" hidden>
                                                <input id="inp-value-id" type="hidden"
                                                       value="{{$processHasUser->user->id}}">
                                                <input id="inp-value-name" type="hidden"
                                                       value="{{$processHasUser->user->full_name}}">
                                                <input id="inp-value-rol" type="hidden"
                                                       value="{{$processHasUser->fk_id_rol}}">
                                                <input id="inp-value-delivery_date" type="hidden"
                                                       value="{{$processHasUser->delivery_date}}">
                                            </td>
                                            <td>
                                                {{$processHasUser->user->full_name}}
                                            </td>
                                            <td>
                                                {{$processHasUser->rol->name}}
                                            </td>
                                            <td>
                                                {{$processHasUser->delivery_date??"No aplica"}}
                                            </td>
                                            <td>
                                                <i class="fas fa-toggle-on"></i>
                                                &nbsp;
                                                &nbsp;
                                                &nbsp;
                                                &nbsp;
                                                <i
                                                        data-process-id="{{$processHasUser->id}}"
                                                        class="fas fa-user-edit cursor-pointer text-primary btn-edit-process-user"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Actualizar"></i>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Sin docentes</td>
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
    </div>
@endsection