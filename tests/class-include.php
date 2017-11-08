<?php
/**
 * Test Class
 */

class Class_Include {
	protected $cons;

	function __construct() {
		$this->cons = CONST_TEST;
	}

	public function print_consts() {
		$cons = $this->cons;
		echo "The constant of CONST_TEST is : {$cons}";
	}
}
