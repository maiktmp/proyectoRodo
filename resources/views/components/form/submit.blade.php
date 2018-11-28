@php
    $class = isset($class) ? $class : '';
@endphp

{!!
    Form::submit(
    $value,
    ['class' => 'btn btn-primary btn-md ' . $class,
    'style' => 'width: 200px'])
!!}