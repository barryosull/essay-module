<?php

class Registration {

	public function __construct($id)
	{
		$this->id = $id;
		$this->module_id = 1234;
		$this->status = "new";
		$this->score = null;
		$this->passed =null;
		$this->time_spent = 0;
	}	
}