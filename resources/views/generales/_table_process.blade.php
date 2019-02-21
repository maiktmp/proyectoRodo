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
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($process as $processIter)
                    <tr class="clickable-row" data-href='{{route('get_process',['processId'=>$processIter->id])}}'>
                        <th scope="col">{{$loop->iteration}}</th>
                        <th scope="col">{{
                                $processIter->hasUser()->whereFkIdRol(\App\Http\Model\Rol::ESTUDIANTE)->first()->user->full_name
                                }}</th>
                        <th scope="col">{{$processIter->state->name}}</th>
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
                        <th>
                            @if(isset($pdf))
                                <a href="{{route('pdf',["processId"=>$processIter->id])}}">
                                    <i class="fas fa-file-signature fa-2x text-primary"></i>
                                </a>
                            @endif
                        </th>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Sin registros</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>