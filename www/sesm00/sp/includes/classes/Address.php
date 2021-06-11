<?php


class Address extends Model
{

    protected const TABLE_NAME = ADDRESS_TABLE;
    protected $attrMap = [
        "firstname",
        "lastname",
        "street",
        "city",
        "zip",
        "phone",
        "users_id",
    ];

    public static $objectCache = [];

    public $firstname;
    public $lastname;
    public $street;
    public $city;
    public $zip;
    public $phone;
    public $users_id;

    public function __construct($id, $firstname = "", $lastname = "", $street = "", $city = "", $zip = "", $phone = "", $users_id = 0)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->street = $street;
        $this->city = $city;
        $this->zip = $zip;
        $this->phone = $phone;
        $this->users_id = $users_id;

        parent::__construct($id);
    }

    public function validate()
    {
        if (strlen($this->firstname) < 1) {
            return array('success' => false, 'msg' => "Jméno je moc krátké");
        }

        if (strlen($this->lastname) < 1) {
            return array('success' => false, 'msg' => "Příjmení je moc krátké");
        }

        if (strlen($this->street) < 1) {
            return array('success' => false, 'msg' => "Ulice je moc krátká");
        }

        if (strlen($this->zip) < 5) {
            return array('success' => false, 'msg' => "PSČ je moc krátké");
        }

        if (!isPhoneNumber($this->phone)) {
            return array('success' => false, 'msg' => "Telefon musí mít 9 čísel a může být včetně předvolby");
        }

        if ($this->users_id == 0) {
            return array('success' => false, 'msg' => "Uživatel neexistuje");
        }

        return array('success' => true);
    }

    public function existsAsAnotherId() {
        $fields = array();
        foreach ($this->attrMap as $attr) {
            $fields[$attr] = $this->$attr;
        }
        return Database::getInstance()->getValue(ADDRESS_TABLE, "id", $fields);
    }
}