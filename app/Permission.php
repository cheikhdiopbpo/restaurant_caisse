<?php
namespace App;

class Permission extends \Spatie\Permission\Models\Permission
{

    public static function defaultPermissions()
    {
        return [
            'view_users',
            'add_users',
            'edit_users',
            'delete_users',

            
            'view_roles',
            'add_roles',
            'edit_roles',
            'delete_roles',

            'view_categories',
            'add_categories',
            'edit_categories',
            'delete_categories',

            'view_plats',
            'add_plats',
            'edit_plats',
            'delete_plats',
        ];
    }

}
