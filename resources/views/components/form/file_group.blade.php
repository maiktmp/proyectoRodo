@php
    $errorClass = $errors->has($errorName)
          ? 'is-invalid'
          : '';

    $class = isset($class) ? $class : '';

    $disabled = isset($disabled)
        ? $disabled
        : false;
@endphp

<div class="custom-file mb-3">
    {{ Form::file(
        $name,
        [
            'class' => 'custom-file-input ' . $errorClass . ' ' . $class ,
            'disabled' => $disabled,
            'id' => isset($id) ? $id : null
        ]
    ) }}
    {!! Form::label(
    $name,
    isset($label) ? $label : null,
    [
    'class'=>'custom-file-label '. (isset($labelClass) ? $labelClass : "")
    ]
) !!}

    @if($errors->has($errorName))
        <div class="invalid-feedback">
            {{ $errors->first($errorName) }}
        </div>
    @endif
</div>