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
        'class'=>isset($labelClass) ? $labelClass :""
        ]
    ) !!}

    {{ Form::number(
        $name,
        isset($value) ? $value : null,
        [
            'step'=>isset($step)?$step:".01",
            'class' => 'form-control ' . $errorClass . ' ' . $class ,
            'disabled' => $disabled,
            'max'=>  isset($max) ? $max : null,
            'min'=>  isset($min) ? $min : 0,
            'id' => isset($id) ? $id : null
        ]
    ) }}
    @if($errors->has($errorName))
        <div class="invalid-feedback">
            {{ $errors->first($errorName) }}
        </div>
    @endif
</div>