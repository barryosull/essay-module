<?php

use \Mockery as m;

class ManifestTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->manifest = new Manifest();
		$this->system = m::mock('System');
		$this->system->shouldReceive('file_get_contents')->andReturn( $this->question_json() );
		$this->manifest->load('path/to/manifest', $this->system);
	}

	private function question_json()
	{
		return '{
			"questions": [1,2,3]
		}';
	}

	public function test_get_question_data()
	{
		$this->assertEquals( array(1,2,3), $this->manifest->get_questions());
	}

	public function test_fails_for_broken_json()
	{
		$this->setExpectedException('ManifestException',"Manifest JSON is invalid");

		$system = m::mock('System');
		$system->shouldReceive('file_get_contents')->andReturn('[asdasd');
		$this->manifest->load('path/to/manifest', $system);
	}

	public function test_fails_if_questions_are_missing()
	{
		$this->setExpectedException('ManifestException',"Manifest has no questions");

		$system = m::mock('System');
		$system->shouldReceive('file_get_contents')->andReturn('{}');
		$this->manifest->load('path/to/manifest', $system);
	}
}