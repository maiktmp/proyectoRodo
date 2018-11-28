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
    {{ Form::textarea(
        $name,
        isset($value) ? $value : null,
        [
            'class' => 'form-control ' . $errorClass . ' ' . $class ,
            'disabled' => $disabled,
            'id' => isset($id) ? $id : null,
            'style' => 'resize: none;',
            'rows'=>$rows,
        ]
    ) }}
    @if($errors->has($errorName))
        <div class="invalid-feedback">
            {{ $errors->first($errorName) }}
        </div>
    @endif
</div>