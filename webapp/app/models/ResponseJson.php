<?php

class ResponseJson 
{
	protected $data;

	public function __construct($data = null)
	{
		$this->data = $data;
	}

	public function __toString()
	{
		$response = new stdClass();
		$response->success = true;
		if ($this->data) {
			$response->data = $this->data;
		}
		return json_encode($response);
	}
}