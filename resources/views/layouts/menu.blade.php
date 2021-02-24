@if (Auth::check())

<li class="nav-item has-treeview menu-open">
    <a href="#" class="nav-link active">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
        Administration
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
     @can('view_users') 
      <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link active">
          <i class="far fa-circle nav-icon"></i>
          <p>Utilisateurs</p>
        </a>
      </li>
      @endcan
      @can('view_roles')
      <li class="nav-item">
        <a href="{{ route('roles.index') }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Roles</p>
        </a>
      </li>
      @endcan
    </ul>
  </li>
  <li class="nav-item has-treeview menu-open">
    <a href="#" class="nav-link active">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
        Restaurant
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
     @can('view_users') 
      <li class="nav-item">
        <a href="{{ route('categories.index') }}" class="nav-link active">
          <i class="far fa-circle nav-icon"></i>
          <p>Menu</p>
        </a>
      </li>
      @endcan
      @can('view_plats') 
      <li class="nav-item">
        <a href="{{ route('plats.index') }}" class="nav-link active">
          <i class="far fa-circle nav-icon"></i>
          <p>Plats</p>
        </a>
      </li>
      @endcan
      <li class="nav-item">
        <a href="{{ route('inventaire.index') }}" class="nav-link active">
          <i class="far fa-circle nav-icon"></i>
          <p>Inventaire</p>
        </a>
      </li>

    </ul>
  </li>
  

  @endif
