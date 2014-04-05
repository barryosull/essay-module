<?php

class QuestionTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		Question::table()->delete(array());

		$module = new Module();
		$module->id = 2;
		$this->questions = new QuestionCollection($module);
	}

	public function test_that_questions_is_initially_empty()
	{
		$this->assertEquals(0, count($this->questions));
	}

	public function test_unique_keys_must_have_values()
	{
		$this->setExpectedException('QuestionException', "No unique key supplied for question");

		$question = new stdClass();
		$question->text= 'What is life?';
		$this->questions->load_from_data_objects( array($question) );
	}

	private function load_questions()
	{
		$this->questionObj1 = new stdClass();
		$this->questionObj1->unique_key = 22;
		$this->questionObj1->text = 'What is the square root of things?';
		
		$this->questionObj2 = new stdClass();
		$this->questionObj2->unique_key = 'asd';
		$this->questionObj2->text= 'What is life?';

		$this->questions->load_from_data_objects( array($this->questionObj1, $this->questionObj2) );
	}

	public function test_load_questions_from_data()
	{
		$this->load_questions();

		$this->assertEquals(2, count($this->questions));

		$this->assertEquals(22, $this->questions[0]->unique_key);
		$this->assertEquals($this->questionObj1->text, $this->questions[0]->text);
		
		$this->assertEquals('asd', $this->questions[1]->unique_key);
		$this->assertEquals($this->questionObj2->text, $this->questions[1]->text);
	}

	public function test_that_uploading_over_a_collection_updates_existing_questions()
	{
		$this->load_questions();

		$this->questionObj1->text = 'Updated text?';
		$this->questionObj2->text= 'More updated text?';

		$this->questions->load_from_data_objects( array($this->questionObj1, $this->questionObj2) );

		$this->assertEquals($this->questionObj1->text, $this->questions[0]->text);
		$this->assertEquals($this->questionObj2->text, $this->questions[1]->text);
	}
	
	public function test_that_questions_are_active_by_default()
	{
		$this->load_questions();

		$question1 = $this->questions[0];

		$this->assertTrue($question1->is_active());
	}

	
	public function test_that_removing_a_question_still_keeps_it_in_the_system_but_not_the_collection()
	{
		$this->load_questions();

		$question1 = $this->questions[0];

		$this->questions->load_from_data_objects( array($this->questionObj2) );

		$this->assertEquals(1, count($this->questions));
		$this->assertFalse($question1->is_active());
	}

	public function test_order_is_preserved_from_input_array()
	{
		$this->load_questions();

		$this->questions->load_from_data_objects( array($this->questionObj2, $this->questionObj1) );

		$this->assertEquals($this->questionObj2->unique_key, $this->questions[0]->unique_key);
		$this->assertEquals($this->questionObj1->unique_key, $this->questions[1]->unique_key);
	}
}