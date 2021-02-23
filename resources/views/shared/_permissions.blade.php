<div class="panel panel-default">
    <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
      
        <div class="card">
          <div class="card-header" role="tab" style="background-color: #17A2B8;"  id="{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}">
            <h6 class="mg-b-0">
            <a data-toggle="collapse"style="color: #fff; font-size :20px;" data-parent="#accordion" href="#{{$identity}}" aria-expanded="true" aria-controls="collapseOne" class="tx-gray-800 transition">
              {{ isset($title) ? Str::slug($title) : 'Override Permissions' }} {!! isset($user) ? '<span class="">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
            </a>
            </h6>
          </div><!-- card-header -->
      
          <div id="{{$identity}}" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
            <div class="card-block pd-20">
              <div class="row">
                @foreach($permissions as $perm)
                    <?php
                        $per_found = null;

                        if( isset($role) ) {
                            $per_found = $role->hasPermissionTo($perm->name);
                        }

                        if( isset($user)) {
                            $per_found = $user->hasDirectPermission($perm->name);
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="checkbox">
                            <label class="{{ Str::contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            </div>
          </div>
        </div><!-- card -->
        <!-- ADD MORE CARD HERE -->
      </div>
</div>