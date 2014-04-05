<?php

class ModuleCollection 
{
	protected $org;

	public function __construct(Organisation $org)
	{
		$this->org = $org;
	}

	public function get_by_id($id)
	{
		$module = Module::find($id);
		if($module->organisation_id != $this->org->id) {
			throw new ModuleException("Module ID ".$id." does not belong to organisation ID ".$this->org->id);
		}
		return $module;
	}

	public function create($name)
	{
		if (!$name) {
			throw new ModuleException("Modules require names");
		}
		$module = new Module();
		$module->name = $name;
		$module->organisation_id = $this->org->id;
		$module->save();
		return $module;
	}
}
