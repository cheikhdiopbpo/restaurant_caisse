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

<!-- Permissions -->

 {{-- @if(isset($categorie))
    @include('shared._permissions', ['closed' => 'true', 'model' => $categorie ,'identity'=>'4556' ])
@endif  --}}