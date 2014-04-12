<?php

use \Mockery as m;

class RegistrationTest extends PHPUnit_Framework_TestCase 
{
	public function setUp()
	{
		Registration::table()->delete(array());

		$module = new Module();
		$module->id = 2;

		$this->registrations = new RegistrationCollection($module);
				
		$this->registration = $this->registrations->create(11, $module);
	}

	public function test_registration_is_created_with_default_attributes()
	{
		$this->assertEquals(0, $this->registration->get_time_spent());
		$this->assertFalse($this->registration->is_submitted());
		$this->assertFalse($this->registration->is_marked());
		$this->assertFalse($this->registration->is_passed());
		$this->assertEquals(0, $this->registration->get_mark());
	}

	public function test_create_fails_if_registration_already_exists()
	{
		$this->setExpectedException('RegistrationCollectionException',"Registration ID 11 already exists for Module ID 2");

		$registration = $this->registrations->create(11);
	}

	public function testget_fails_if_registration_doesnt_exists()
	{
		$this->setExpectedException('RegistrationCollectionException',"Registration ID 14 does not exist for Module ID 2");

		$registration = $this->registrations->get_by_id(14);
	}

	public function test_submit()
	{
		$this->registration->submit();

		$this->assertTrue($this->registration->is_submitted());
	}

	public function test_cannot_mark_an_unsubmitted_reg()
	{
		$this->setExpectedException('RegistrationException',"Cannot mark an unsubmitted registration");

		$answerCollection = m::mock('AnswerCollection');
		$this->registration->mark($answerCollection);
	}

	private function mark_registration()
	{
		$this->registration->submit();
		$answerCollection = m::mock('AnswerCollection');
		$answerCollection->shouldReceive('get_total_mark')->andReturn(75);

		$this->registration->mark($answerCollection);
	}

	public function test_mark()
	{
		$this->mark_registration();

		$this->assertTrue($this->registration->is_marked());
		$this->assertEquals(75, $this->registration->get_mark());
	}

	public function test__cant_set_results_on_an_unmarked_registration()
	{
		$this->setExpectedException('RegistrationException', "Cannot set the result for a registration that has not been marked");

		$this->registration->set_result( Registration::PASS );
	}

	public function test_pass_registration()
	{
		$this->mark_registration();

		$this->registration->set_result( Registration::PASS );

		$this->assertTrue($this->registration->is_passed());
	}

	public function test_fail_registration()
	{
		$this->mark_registration();

		$this->registration->set_result( Registration::FAIL );

		$this->assertFalse($this->registration->is_passed());
	}

	public function test_add_time_spent()
	{
		$this->registration->add_time_spent(12);
		$this->registration->add_time_spent(34);

		$this->assertEquals(46, $this->registration->get_time_spent());
	}
}