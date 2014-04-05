<?php

class OrganisationTest extends PHPUnit_Framework_TestCase 
{
	private function blank_table()
	{
		Organisation::table()->delete(array());
	}

	public function setUp()
	{
		$this->blank_table();

		$this->id = 1;
		$this->org = new Organisation();
		$this->org->name = "Name";
		$this->org->id = $this->id;
		$this->org->save();
	}

	public function test_find()
	{
		$orgs = Organisation::find($this->id);	
		$this->assertEquals($this->id, $orgs->id);
	}

	public function test_that_private_keys_are_20_chars_long()
	{
		$this->assertEquals(40, strlen($this->org->private_key));
	}

	public function test_that_private_keys_are_created_automatically()
	{
		$this->assertNotNull($this->org->private_key);
	}

	public function test_that_private_keys_cannot_be_changed()
	{
		$this->setExpectedException('OrganisationException',"Cannot change private key");
		
		$this->org->private_key = 'fadsdfasdf';
	}
}