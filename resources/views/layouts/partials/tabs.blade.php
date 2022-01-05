<ul class="nav nav-tabs">
    <li class="nav-item">
        <a href="{{ route('admin.index') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">Admin</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.users.index') }}"
           class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/create') || request()->is('admin/users/*/edit') ? 'active' : '' }}">Users</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.regions.index') }}"
           class="nav-link {{ request()->is('admin/regions') || request()->is('admin/regions/create')|| request()->is('admin/regions/*') || request()->is('admin/regions/*/edit') ? 'active' : '' }}">Regions</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.adverts_categories.index') }}"
           class="nav-link {{ request()->is('admin/adverts_categories') || request()->is('admin/adverts_categories/create')|| request()->is('admin/adverts_categories/*') || request()->is('admin/adverts_categories/*/edit') ? 'active' : '' }}">Adverts
            Categories</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.advert_variations.index') }}"
           class="nav-link {{ request()->is('admin/advert_variations') || request()->is('admin/advert_variations/create')|| request()->is('admin/advert_variations/*') || request()->is('admin/advert_variations/*/edit') ? 'active' : '' }}">Adverts
            Variations</a>
    </li>
</ul>
