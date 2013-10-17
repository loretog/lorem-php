<?php

class Registry
{
	private $vars = array();		
	public function __construct() {
	}
	public function __set($key, $value) {
		$this->vars[$key] = $value;
	}
	public function __get($key) {
		return isset($this->vars[$key]) ? $this->vars[$key] : null;
	}
}