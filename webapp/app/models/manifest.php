<?php

class ManifestException extends Exception {}

class Manifest
{
	protected $data;

	public function load($path_to_manifest, $system = null)
	{
		$system = ($system) ?: new System();

		$this->data = json_decode( $system->file_get_contents($path_to_manifest) );

		if (!$this->data) {
			throw new ManifestException("Manifest JSON is invalid");
		}
		if (!isset($this->data->questions)) {
			throw new ManifestException("Manifest has no questions");
		}
	}

	public function get_questions()
	{
		return $this->data->questions;
	}
}