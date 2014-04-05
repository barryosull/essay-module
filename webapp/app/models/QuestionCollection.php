<?php

class QuestionException extends Exception {}

class QuestionCollection implements Iterator, Countable, ArrayAccess 
{
	
	protected $position = 0;
	protected $questions;

	private function load_questions()
	{
		$this->questions = Question::find('all',
			array(
				'conditions' => array("module_id = ? AND is_active = 1", array($this->module->id)),
				'order' => 'q_order ASC'
			)
		);
	}

	public function __construct(Module $module)
	{
		$this->module = $module;
		$this->load_questions();
	}	

	public function load_from_data_objects($objects)
	{
		foreach ($objects as $order=>$object) {
			if (!isset($object->unique_key)) {
				throw new QuestionException("No unique key supplied for question");
			}
		}

		foreach ($this->questions as $question) {
			$question->is_active = 0;
			$question->save();
		}

		foreach ($objects as $order=>$object) {
			$question = $this->get_question_by_unique_key($object->unique_key);
			if (!$question) {
				$question = new Question();
				$question->unique_key = $object->unique_key;
			}
			$question->module_id = $this->module->id;
			$question->q_order = $order;
			$question->text = $object->text;
			$question->is_active = 1;

			$question->save();
		}
		$this->load_questions();
	}


	private function get_question_by_unique_key($key)
	{
		foreach($this->questions as $question) {
			if ($question->unique_key == $key && $question->module_id == $this->module->id) {
				return $question;
			}
		}
	}

	public function current()
	{
		return $this->questions[$this->position];
	}

	public function key() 
	{
		return $this->position;
	}
	
	public function next()
	{
		++$this->position;
	}
	
	public function rewind()
	{
		$this->position = 0;
	}

	public function valid()
	{
		return isset($this->questions[$this->position]);
	}

	public function count()
	{
		return count($this->questions);
	}

	public function offsetSet($key, $value) { }   
	public function offsetUnset($key) { }
   
    public function offsetExists($key) {
        return isset($this->questions[$key]);
    }

    public function offsetGet($key) {
        return isset($this->questions[$key]) ? $this->questions[$key] : null;
    }
}