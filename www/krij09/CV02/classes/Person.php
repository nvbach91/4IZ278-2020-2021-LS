<?php 
	class Person{

		public function __construct($logo, $name, $surname, $dateOfBirth, $job, $company, $street, $number, $city, $phone, $email, $webpage, $available)
		{
	        $this->logo = $logo;
	       	$this->name = $name;
	        $this->surname = $surname;
	        $this->dateOfBirth = $dateOfBirth;
	        $this->job = $job;
	        $this->company = $company;
	        $this->street = $street;
	        $this->number = $number;
	        $this->city = $city;
	        $this->phone = $phone;
	        $this->email = $email;
	        $this->webpage = $webpage;
	        $this->available = $available;
		}

		public function getAddress()
		{
			return $this->street . " " . $this->number . ", " . $this->city;
		}

		public function getName()
		{
			return $this->name . " " . $this->surname;
		}

		public function getAge()
		{
			$now = new DateTime('today');
			$difference = $this->dateOfBirth->diff($now);
			return $difference->y;
		}
	}


	


















































?>