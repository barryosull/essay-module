<?php

class System 
{
	public function __call($name, $arguments)
	{
		call_user_func_array($name, $arguments);
	}
}