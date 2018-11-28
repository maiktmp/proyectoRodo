@php
    $errorClass = $errors->has($errorName)
          ? 'is-invalid'
          : '';

              $attributes=[
                'class' => 'form-control ' . $errorClass,
                'placeholder' => isset($placeholder) ? $placeholder : null,
                'id' => isset($id) ? $id : null
                ];
          if(isset($onChange)){
          $attributes['onchange'] = $onChange;
          }
@endphp

<div class="form-group">
    {!! Form::label(
        $name,
        isset($label) ? $label : null,
        [
        'class'=>isset($labelClass) ? $labelClass : ""
        ]
    ) !!}
    {{ Form::select(
        $name,
        $options,
        isset($value) ? $value : null,
        $attributes
    ) }}
    @if($errors->has($errorName))
        <div class="invalid-feedback">
            {{ $errors->first($errorName) }}
        </div>
    @endif
</div>