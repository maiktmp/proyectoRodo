@php
    /* @var $process \App\Http\Model\Process*/
@endphp
        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('') }}" type="image/png">

    @include('template.global_css')
    @stack('css')
    <style>
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body style="">
<div style="margin-top: 5px" class="col-12">
    <p class="text-center">
        <b>ANEXO III</b>
        <b>Formato de libreación del proyecto para la titulación integral</b>
    </p>
    <p class="text-right">
        Toluca, Estado de México, {{\Carbon\Carbon::now()->format('d/m/Y')}}<br>
        ASUNTO: Liberación de Proyecto para Titulación integral.
    </p>
</div>
<div style="margin-top: 5px" class="col-12">
    <p class="text-left">
        <b>
            C. ___________________________________________ <br>
            JEFE DE LA DICISIÓN DE ESTUDIOS PROFESIONALES <br>
            P R E S E N T E. <br>
        </b>
    </p>
</div>
<div style="margin-top: 5px" class="col-12">
    <p class="text-left">
        Por este medio le informo que ha sido liberado el siguiente proyecto para la Titulación integral:
    </p>
</div>
<div style="margin-top: 5px" class="col-12">
    <table>
        <tbody>
        <tr>
            <td style="width: 200px"><b>a) Nombre del Egresado: </b></td>
            <td style="width: 450px;">{{$process->getStudent()->user->getFullNameAttribute()}}</td>
        </tr>
        <tr>
            <td style="width: 200px"><b>b) Carrera: </b></td>
            <td style="width: 450px;">{{$process->getStudent()->user->carrera}}</td>
        </tr>
        <tr>
            <td style="width: 200px"><b>c) No. Control: </b></td>
            <td style="width: 450px;">{{$process->getStudent()->user->no_control}}</td>
        </tr>
        <tr>
            <td style="width: 200px"><b>d) Nombre del proyecto: </b></td>
            <td style="width: 450px;">{{$process->name}}</td>
        </tr>
        <tr>
            <td style="width: 200px"><b>d) Producto: </b></td>
            <td style="width: 450px;">{{$process->producto}}</td>
        </tr>
        </tbody>
    </table>
</div>
<div style="margin-top: 5px" class="col-12">
    <p class="text-left">
        Agradezco de antemano su valisoso apoyo en esta importante actividad para la formación profesional de nuestros
        egresados.
    </p>
    <p><b>A T E N T A M E N T E.</b></p>
    <br><br><br><br>
</div>
<div style="margin-top: 5px" class="col-12">
    <p>
        <b>NOMBRE Y FIRMA </b> <br>
        <b>JEFE DEL DEPARTAMENTO ACADÉMICO</b>
    </p>
</div>
<div style="margin-top: 5px" class="col-12">
    <table>
        <tbody>
        <tr>
            <td style="width: 210px;  height: 100px"></td>
            <td style="width: 210px;  height: 100px"></td>
            <td style="width: 210px;  height: 100px"></td>
        </tr>
        <tr>
            <td class="text-center" style="height: 50px">Nombre y Firma del <br> Asesor</td>
            <td class="text-center" style="height: 50px">Nombre y Firma del <br> Revisor</td>
            <td class="text-center" style="height: 50px">Nombre y Firma del <br> Revisor</td>
        </tr>
        </tbody>
    </table>
</div>
@include('template.global_js')
@stack('scripts')
</body>
</html>