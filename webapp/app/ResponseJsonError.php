<?php

class App_ResponseJsonError
{
	protected $errors;

	public function __construct($errors = array())
	{
		$this->errors = $errors;
	}

	public function append($error) 
	{
		$this->errors[] = $error;
	}

	public function __toString()
	{
		$response = new stdClass();
		$response->success = false;
		$response->data = $this->data;

		return json_encode($response);
	}
}