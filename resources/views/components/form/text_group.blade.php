@php
    /*** $labelClass -> Add class to label*/

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

    {{ Form::text(
        $name,
        isset($value) ? $value : null,
        [
            'class' => 'form-control ' . $errorClass . ' ' . $class ,
            'disabled' => $disabled,
            'id' => isset($id) ? $id : null
        ]
    ) }}
    @if($errors->has($errorName))
        <div class="invalid-feedback">
            {{ $errors->first($errorName) }}
        </div>
    @endif
</div>