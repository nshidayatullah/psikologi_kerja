<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public static function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define Permissions
        $permissions = [
            // User Management
            'view_any_user',
            'view_user',
            'create_user',
            'update_user',
            'delete_user',

            // RBAC Management
            'view_any_role',
            'view_role',
            'create_role',
            'update_role',
            'delete_role',
            'view_any_permission',
            'view_permission',
            'create_permission',
            'update_permission',
            'delete_permission',

            // Questionnaire Management
            'view_any_question_category',
            'view_question_category',
            'create_question_category',
            'update_question_category',
            'delete_question_category',
            'view_any_question',
            'view_question',
            'create_question',
            'update_question',
            'delete_question',

            // Survey Management
            'view_any_survey_session',
            'view_survey_session',
            'create_survey_session',
            'update_survey_session',
            'delete_survey_session',
            'view_any_survey_response',
            'view_survey_response',
            'update_survey_response',
            'delete_survey_response',

            // Signer Management
            'view_any_signer',
            'view_signer',
            'create_signer',
            'update_signer',
            'delete_signer',

            // Reports
            'view_reports',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        // Create Roles and Assign Permissions

        // Admin
        $admin = Role::findOrCreate('admin');
        // Admin gets all via Gate::before in AuthServiceProvider, but good to assign anyway
        $admin->syncPermissions(Permission::all());

        // PIC
        $pic = Role::findOrCreate('pic');
        $pic->syncPermissions([
            'view_any_survey_session',
            'view_survey_session',
            'create_survey_session',
            'view_any_survey_response',
            'view_survey_response',
            'view_any_signer',
            'view_signer',
            'view_reports',
        ]);
    }
}
