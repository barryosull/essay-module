<?php

use \Mockery as m;

class ModuleTest extends PHPUnit_Framework_TestCase 
{
	private function blank_table()
	{
		Module::table()->delete(array());
	}

	public function setUp()
	{
		$this->blank_table();
		$organisation = new Organisation();
		$this->modules = new ModuleCollection($organisation);
		$this->module = $this->modules->create("Name");
	}

	public function tearDown() {
        m::close();
    }

    public function test_get_module()
    {
    	$module = $this->modules->get_by_id($this->module->id);
    	$this->assertEquals($this->module->id, $module->id);
    }

    public function test_can_only_get_module_for_your_organisation()
    {
    	$organisation2 = new Organisation();
    	$organisation2->id = 2;
    	$modules = new ModuleCollection($organisation2);
		$this->setExpectedException('ModuleException',"Module ID ".$this->module->id." does not belong to organisation ID 2");

		$modules->get_by_id($this->module->id);
    }

	public function test_create_requires_name()
	{
		$this->setExpectedException('ModuleException',"Modules require names");
		$module = $this->modules->create("");
	}

	public function test_that_modules_have_default_branding()
	{
		$this->assertEquals('#FFFFFF', $this->module->get_branding()->value);
	}

	public function test_that_modules_that_havent_been_imported_are_not_active()
	{
		$this->assertFalse($this->module->is_active());
	}

	public function test_that_files_can_be_uploaded()
	{
		$path_to_file = 'path/to/file';
		$path_to_unzip = 'files/modules/'.$this->module->id;
		$unzip = m::mock('Unzipper');
		$unzip->shouldReceive('load_file')->with($path_to_file)->once();
		$unzip->shouldReceive('unzip_to')->with($path_to_unzip)->once();

		$this->module->upload($path_to_file, $unzip);
	}

	public function test_that_import_breaks_if_there_is_no_file()
	{
		$this->setExpectedException('ModuleException',"There are no files to import");

		$manifestLoader = m::mock('Manifest');
		$path_to_manifest = 'files/modules/'.$this->module->id.'/manifest.json';
		$manifestLoader->shouldReceive('load')->with($path_to_manifest)->andReturn(false);
		$this->module->import($manifestLoader);
	}

	public function test_that_import_creates_questions()
	{
		$path_to_manifest = 'files/modules/'.$this->module->id.'/manifest.json';

		$questionData = 'data';

		$manifestLoader = m::mock('Manifest');
		$manifestLoader->shouldReceive('load')->with($path_to_manifest)->once()->andReturn(true);
		$manifestLoader->shouldReceive('get_questions_data')->andReturn($questionData);

		$questionsCollection = m::mock('QuestionCollection');
		$questionsCollection->shouldReceive('load_from_data_objects')->with($questionData)->once();

		$this->module->import($manifestLoader, $questionsCollection);

		$this->assertTrue($this->module->is_active());
	}
}