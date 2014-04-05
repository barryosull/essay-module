<?php

class OrganisationException extends Exception {}

class Organisation extends ActiveRecord\Model
{
	static $before_create = array('create_private_key'); # 

	public function create_private_key()
	{
		$this->private_key = hash('sha1', 'Tercet '.rand());
	}

	public function set_private_key($key)
	{
		if ($this->private_key) {
			throw new OrganisationException("Cannot change private key");
		}
		$this->assign_attribute('private_key', $key);
	}
}