<?php

class Question extends ActiveRecord\Model
{
	public function is_active() 
	{
		return (bool)$this->is_active;
	}
}