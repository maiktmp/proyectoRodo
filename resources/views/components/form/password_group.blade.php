@php
    $errorClass = $errors->has($errorName)
          ? 'is-invalid'
          : '';

    $class = isset($class) ? $class : '';

    $disabled = isset($disabled)
        ? $disabled
        : false;
@endphp

<div class="form-group">
    {!! Form::label(
        $name,
        isset($label) ? $label : null,
        [
        'class'=>isset($labelClass) ? $labelClass : ""
        ]
    ) !!}

    {{ Form::password(
        $name,
        [
            'class' => 'form-control ' . $errorClass . ' ' . $class ,
            'disabled' => $disabled,
            'id' => isset($id) ? $id : null
        ]
    ) }}
    @if($update)
        {!! Form::label(
            'password',
            '*Deje este campo vacío para conservar la contraseña',
            ['class' => 'control-label color-coffee-dark',
             'style' => 'font-size: 0.9em']
        ) !!}
    @endif
    @if($errors->has($errorName))
        <div class="invalid-feedback">
            {{ $errors->first($errorName) }}
        </div>
    @endif
</div>