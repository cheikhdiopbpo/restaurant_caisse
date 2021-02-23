@can('edit_'.$entity)
    <a href="{{ route($entity.'.edit', [Str::singular($entity) => $id])  }}" class="btn btn-xs btn-info">
    <i class="fa fa-edit"></i></a>
@endcan

@can('delete_'.$entity)
    {{-- {{dd($id)}} --}}
    {!! Form::open( ['method' => 'delete', 'url' => route($entity.'.destroy',[Str::singular($entity) => $id]), 'style' => 'display: inline', 'onSubmit' => 'return confirm("Are yous sure wanted to delete it?")']) !!}
        <button type="submit" class="btn-delete btn btn-xs btn-danger">
            <i class="fa fa-trash"></i>
        </button>
    {!! Form::close() !!}
@endcan
