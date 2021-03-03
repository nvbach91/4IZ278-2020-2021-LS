
<?php
	class BusinessCard {
		public function __construct(
			$companyName, $slogan, 
			$degBefore, $givenName, $surname, $degAfter,
			$street, $number, $zipCode, $city, $country,
			$phone, $email, $webURL
		){
			$this->companyName = $companyName;
			$this->slogan = $slogan;
			$this->degBefore = $degBefore;
			$this->givenName = $givenName;
			$this->surname = $surname;
			$this->degAfter = $degAfter;
			$this->street = $street;
			$this->number = $number;
			$this->zipCode = $zipCode;
			$this->city = $city;
			$this->country = $country;
			$this->phone = $phone;
			$this->email = $email;
			$this->webURL = $webURL;
		}

		public function getCompanyName(){
			return $this->companyName;
		}
		public function getSlogan(){
			return $this->slogan;
		}
		public function getFullName(){
			if($this->degAfter == ''){ // fix dangling comma
				return "$this->degBefore $this->givenName $this->surname";
			}else{
				return "$this->degBefore $this->givenName $this->surname, $this->degAfter";
			}
		}
		public function getStreetNumber(){
			return "$this->street $this->number";
		}
		public function getZipCity(){
			return "$this->zipCode $this->city";
		}
		public function getCountry(){
			return $this->country;
		}
		public function getPhone(){
			return $this->phone;
		}
		public function getEmail(){
			return $this->email;
		}
		public function getwebURL(){
			return $this->webURL;
		}

	}


	$businessCards = [
		new BusinessCard (
			'Getman Systems, s.r.o.',
			'The weirdest software on the planet, both free and paid.',
			'HaDr.', 'Johannes', 'Getmann', 'BSE',
			'Konopna','420/69','169 00','Pragl','Cajzlistan',
			'+420 123 456 789','getj00 (a) vse , cz',
			'https://getmania.blogspot.com'
		),
		new BusinessCard (
			'Ferda Mravenec - Prace vseho druhu',
			'',
			'Mr.', 'Ferda', 'Mravenec', '',
			'Anthill','in the woods','666 99','Ondrejov','Czechia',
			'','',
			''
		),
		new BusinessCard (
			'Association associating association, z.s.',
			'Yo dawg, I heard you like associations, so I put some associations in an association, so you can associate while you associate.',
			'RNDr.', 'Rudolf', 'Rekurentni', 'DrSc.',
			'Street St','314','112 35','Luxembourg','Luxembourg',
			'+420 112 358 1321','aaa (a) aaa.aaa.aa',
			'https://aaa.aaa.aa/'
		),
		new BusinessCard (
			'CompuHyperGlobalMegaNet, Inc.',
			'',
			'', 'Homer', 'Simpson', '',
			'','','','Springfield, OH','USA',
			'+1-800-789-CHGM','',
			'http://compuhyperglobalmeganet.com'
		),
		new BusinessCard (
			'Intergalactic internationale, z.s.',
			'The last battle has begun.',
			'', 'E.', 'T.', '',
			'Marksa','1917/10','555 55','Novij Novosibirsk','Mars',
			'','gensec (a) intint , gal',
			'https://www.intint.gal'
		)

		]

?>

