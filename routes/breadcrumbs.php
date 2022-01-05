<?php

use App\Models\Advert\Variation;
use App\Models\AdvertsCategory;
use App\Models\Region;
use App\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('cabinet', function ($trail) {
    $trail->parent('home');
    $trail->push('Cabinet', route('cabinet'));
});

Breadcrumbs::for('login', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Login', route('login'));
});

Breadcrumbs::for('register', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Register', route('register'));
});

// Home > Blog
Breadcrumbs::for('contact', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Contacts', route('contact'));
});

Breadcrumbs::for('admin.index', function ($trail) {
    $trail->push('Admin', route('admin.index'));
});

//================= Users
Breadcrumbs::for('admin.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Users', route('admin.users.index'));
});

Breadcrumbs::for('admin.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.users.index');
    $trail->push('Create', route('admin.users.create'));
});

Breadcrumbs::for('admin.users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('admin.users.index');
    $trail->push($user->name, route('admin.users.show', $user));
});

Breadcrumbs::for('admin.users.edit', function ($trail, User $user) {
    $trail->parent('admin.users.show', $user);
    $trail->push('Edit', route('admin.users.edit', $user));
});

//================= Regions
Breadcrumbs::for('admin.regions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Regions', route('admin.regions.index'));
});

Breadcrumbs::for('admin.regions.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.regions.index');
    $trail->push('Create', route('admin.regions.create'));
});

Breadcrumbs::for('admin.regions.show', function (BreadcrumbTrail $trail, Region $region) {
    if ($region->parent) {
        $trail->parent('admin.regions.show', $region->parent);
    } else {
        $trail->parent('admin.regions.index');
    }
    $trail->push($region->name, route('admin.regions.show', $region));
});

Breadcrumbs::for('admin.regions.edit', function ($trail, Region $region) {
    $trail->parent('admin.regions.show', $region);
    $trail->push('Edit', route('admin.regions.edit', $region));
});

//========= Adverts categories
Breadcrumbs::for('admin.adverts_categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Adverts Categories', route('admin.adverts_categories.index'));
});

Breadcrumbs::for('admin.adverts_categories.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.adverts_categories.index');
    $trail->push('Create', route('admin.adverts_categories.create'));
});

Breadcrumbs::for('admin.adverts_categories.show', function (BreadcrumbTrail $trail, AdvertsCategory $advertsCategory) {
    if ($advertsCategory->parent) {
        $trail->parent('admin.adverts_categories.show', $advertsCategory->parent);
    } else {
        $trail->parent('admin.adverts_categories.index');
    }
    $trail->push($advertsCategory->name, route('admin.adverts_categories.show', $advertsCategory));
});

Breadcrumbs::for('admin.adverts_categories.edit', function ($trail, AdvertsCategory $advertsCategory) {
    $trail->parent('admin.adverts_categories.show', $advertsCategory);
    $trail->push('Edit', route('admin.adverts_categories.edit', $advertsCategory));
});

//========= Adverts attributes
Breadcrumbs::for('admin.adverts_attributes.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Adverts Attributes', route('admin.adverts_attributes.index'));
});

Breadcrumbs::for('admin.adverts_attributes.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.adverts_attributes.index');
    $trail->push('Create', route('admin.adverts_attributes.create'));
});

Breadcrumbs::for('admin.adverts_attributes.show', function (BreadcrumbTrail $trail, AdvertsCategory $advertsCategory) {
    if ($advertsCategory->parent) {
        $trail->parent('admin.adverts_attributes.show', $advertsCategory->parent);
    } else {
        $trail->parent('admin.adverts_attributes.index');
    }
    $trail->push($advertsCategory->name, route('admin.adverts_attributes.show', $advertsCategory));
});

Breadcrumbs::for('admin.adverts_attributes.edit', function ($trail, AdvertsCategory $advertsCategory) {
    $trail->parent('admin.adverts_attributes.show', $advertsCategory);
    $trail->push('Edit', route('admin.adverts_attributes.edit', $advertsCategory));
});

//============= Variations
Breadcrumbs::for('admin.advert_variations.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Adverts Variations', route('admin.advert_variations.index'));
});

Breadcrumbs::for('admin.advert_variations.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.advert_variations.index');
    $trail->push('Create', route('admin.advert_variations.create'));
});

Breadcrumbs::for('admin.advert_variations.show', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('admin.advert_variations.index');
    $variation = Variation::findOrFail($id);
    $trail->push($variation->name, route('admin.advert_variations.show', $id));
});
Breadcrumbs::for('admin.advert_variations.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('admin.advert_variations.show', $id);
    $trail->push('Edit', route('admin.advert_variations.edit', $id));
});
