<?php

class RegistrationException extends Exception {}

class Registration extends ActiveRecord\Model
{
	CONST PASS = true;
	CONST FAIL = false;

	public function get_id()
	{
		return $this->read_attribute('external_id');
	}

	public function set_id($id)
	{
		$this->assign_attribute('external_id', $id);
	}

	public function submit()
	{
		$this->submitted = true;
	}

	public function is_submitted()
	{
		return (bool)$this->submitted;
	}

	public function is_passed()
	{
		return (bool)$this->passed;
	}

	public function add_time_spent($time)
	{
		$this->time_spent += $time;
	}

	public function get_time_spent()
	{
		return $this->read_attribute('time_spent');
	}

	public function mark(AnswerCollection $answers)
	{
		if (!$this->is_submitted()) {
			throw new RegistrationException("Cannot mark an unsubmitted registration");
		}
		$this->mark = $answers->get_total_mark();
	}

	public function is_marked()
	{
		return !is_null($this->mark);
	}

	public function get_mark()
	{
		return $this->read_attribute('mark');
	}

	public function set_result($result)
	{
		if (!$this->is_marked()) {
			throw new RegistrationException("Cannot set the result for a registration that has not been marked");
		}
		$this->passed = (bool)$result;
	}
}