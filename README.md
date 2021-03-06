Permissions
===========

Tiny Laravel 5 package for handling user roles and permissions.

Installation
============

Add the following to the require key of your composer.json file:

    "s00d/permissions": "dev-master"
    
        
Run `$ composer update`.

Navigate to your `config/app.php` file and add `'s00d\Permissions\PermissionsServiceProvider'` to the `$providers` array.

Create the tables by running `$ php artisan migrate package="s00d/permissions"`. Ensure that your `users` table exists first.

Navigate to your `models/User.php` file and add the `s00d\Permissions\Can` trait below the class decloration line:

    class User extends Eloquent implements UserInterface, RemindableInterface {
        use s00d\Permissions\Can;
        
Usage
=====

Create a new role:

    $role = new \s00d\Permissions\Role();
    $role->name = 'Administrator';
    $role->save();
    
Create a new permission:

    $permission = new \s00d\Permissions\Permission();
    $permission->name = 'read_articles';
    $permission->display_name ='Can read articles';
    $permission->save();
    
Attach the permission to the role:
  
    $role->allow($permission);
    
Create a user:

    $user = new User;
    $user->role_id = 1;
    $user->save();
    
And you're set! To check if a user has a permission:

    $user = User::find(1);

    if ($user->can('read_articles'))
        echo 'The user with the ID of "1" can read articles';
        
To check if the current authenticated user has a permission:

    if (Auth::user()->can('read_articles'))
        echo 'The current authenticated user can read articles';
        
