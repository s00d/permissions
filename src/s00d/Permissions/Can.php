<?php namespace s00d\Permissions;

trait Can
{
	public function role()
	{
		return $this->belongsTo('\s00d\Permissions\Role', 'role_id');
	}

	public function can($permission)
	{
		return $this->role->can($permission);
	}
}