<?php

class RegistrationCollectionException extends Exception {}

class RegistrationCollection
{
	protected $module;

	public function __construct(Module $module)
	{
		$this->module = $module;
	}

	public function get_by_id($id)
	{
		$existingRegistration = Registration::find_by_external_id_and_module_id($id, $this->module->id);
		if (!isset($existingRegistration)) {
			throw new RegistrationCollectionException("Registration ID $id does not exist for Module ID {$this->module->id}");
		}
		return $existingRegistration;
	}

	public function create($id)
	{
		$existingRegistration = Registration::find_by_external_id_and_module_id($id, $this->module->id);
		if ($existingRegistration) {
			throw new RegistrationCollectionException("Registration ID $id already exists for Module ID {$this->module->id}");
		}

		$registration = new Registration();
		$registration->id = $id;
		$registration->module_id = $this->module->id;

		$registration->submitted = false;
		$registration->mark = null;
		$registration->passed = false;
		$registration->time_spent = 0;

		$registration->save();

		return $registration;
	}
}