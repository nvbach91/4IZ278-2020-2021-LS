<?php
class Person
{
	public function __construct($name, $second, $planet, $img, $web, $email, $phone, $status)
	{
		$this->firstName = $name;
		$this->secondName = $second;
		$this->planet = $planet;
		$this->photo = $img;
		$this->web = $web;
		$this->email = $email;
		$this->phone = $phone;
		$this->status = $status;
	}

	public function getFullName()
	{
		return "$this->firstName $this->secondName";
	}
}
?>
