<!-- Name Form Input -->
<div class="form-group @if ($errors->has('libelle')) has-error @endif">
    {!! Form::label('name', 'Libelle') !!}
    {!! Form::text('libelle', null, ['class' => 'form-control','style'=>'text-transform: uppercase', 'placeholder' => 'Libelle' ,]) !!}
    @if ($errors->has('libelle')) <p class="help-block">{{ $errors->first('libelle') }}</p> @endif
</div>

<!-- email Form Input -->
<div class="form-group @if ($errors->has('description')) has-error @endif">
    {!! Form::label('description', 'Description') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'style'=>'text-transform: uppercase','placeholder' => 'Description']) !!}
    @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
</div>

<div class="form-group">
    <label for="image">{{ __('image') }}</label>
    <div class="custom-file">
      <input type="file" class="custom-file-input" id="customFile" name="image">
      <label class="custom-file-label" for="customFile">Prendre une photo</label>
    </div>
  </div>

