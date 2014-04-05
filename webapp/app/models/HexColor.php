<?php

class HexColor 
{
	protected $value;

	public function __construct($value)
	{
		$this->value = '#'.$value;
	}

	public function __get($value)
	{
		return $this->$value;
	}
}