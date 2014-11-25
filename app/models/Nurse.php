<?php

class Nurse extends Eloquent
{
	protected $table = "nurses";

	public function nursecustomer()
	{
		$this->hasmany('customernurse', 'nurse_id', 'id');
	}
}