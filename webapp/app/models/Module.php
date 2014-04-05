<?php

class ModuleException extends Exception {}

class Module extends ActiveRecord\Model
{
	public function upload($path_to_file, Unzipper $unzipper = null)
	{
		$unzipper = ($unzipper) ?: new Unzipper();

		$unzipper->load_file($path_to_file);

		$path_to_module ='files/modules/'.$this->id;

		$unzipper->unzip_to($path_to_module);
	}

	public function is_active()
	{
		return (bool)$this->is_active;
	}

	public function import(Manifest $manifest = null, QuestionCollection $questions = null)
	{
		$manifest = ($manifest) ?: new Manifest();
		$questions = ($questions) ?: new QuestionCollection($this);

		$path_to_manifest ='files/modules/'.$this->id.'/manifest.json';

		$is_loaded = $manifest->load($path_to_manifest);

		if (!$is_loaded) {
			throw new ModuleException("There are no files to import");
		}

		$questions->load_from_data_objects( $manifest->get_questions_data() );

		$this->is_active = 1;
		$this->save();
	}

	public function get_branding()
	{
		return new HexColor('FFFFFF');
	}
}