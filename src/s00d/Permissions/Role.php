<?php namespace s00d\Permissions;

class Role extends \Eloquent
{
	protected $table = 'roles';

	public function can($permission)
	{
		$rolePermissions = \s00d\Permissions\RolePermission::role($this->id);

		foreach ($rolePermissions as $rolePermission) {
			if ($rolePermission->permission->name == $permission) {
				return true;
			}
		}

		return false;
	}

	public function allow(\s00d\Permissions\Permission $permission)
	{
		$rolePermission = new \s00d\Permissions\RolePermission();
		$rolePermission->role_id = $this->id;
		$rolePermission->permission_id = $permission->id;
		$rolePermission->save();
	}
	
	public function deny(\s00d\Permissions\Permission $permission)
	{
		$permission->delete();
	}
}
