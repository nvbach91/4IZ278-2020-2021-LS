<?php


class User extends Model
{
    private static $logged_in;
    private static $logged_in_id;
    public static $objectCache = [];

    protected const TABLE_NAME = USERS_TABLE;

    protected $attrMap = [
        "firstname",
        "lastname",
        "email",
        "password",
        "phone",
        "token",
        "google_id"
    ];

    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $phone;
    public $token;
    public $google_id;

    public function __construct($id, $firstname = "", $lastname = "", $email = "", $password = "", $phone = "", $token = "", $google_id = 0)
    {
        parent::__construct($id);

        if ($id=-1) {
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->password = $password;
            $this->email = $email;
            $this->phone = $phone;
            $this->token = $token;
            $this->google_id = $google_id;
        }
    }

    public function create()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::create();
    }

    public function validate()
    {

        if (strlen($this->firstname) < 1) {
            return array('success' => false, 'msg' => "Jméno je moc krátké");
        }

        if (strlen($this->lastname) < 1) {
            return array('success' => false, 'msg' => "Příjmení je moc krátké");
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return array('success' => false, 'msg' => "Email není platný");
        }

        if (strlen($this->password) < 6) {
            return array('success' => false, 'msg' => "Heslo je moc krátké. Minimum je 6 znaků");
        }

        if (!isPhoneNumber($this->phone)) {
            return array('success' => false, 'msg' => "Telefon musí mít 9 čísel a může být včetně předvolby");
        }

        $result = Database::getInstance()->getValue(USERS_TABLE, "COUNT(id) AS count", array('email' => $this->email));
        if ($result != 0) {
            return array('success' => false, 'msg' => "Uživatel s tímto emailem již existuje");
        }

        return array('success' => true);
    }

    public static function login($email, $password) {
        $pass = Database::getInstance()->getValue( USERS_TABLE, "password", array('email' => $email));
        if ($pass === false) {
            return array('success' => false, 'msg' => "Uživatelské jméno nebo heslo není správné");
        }
        if (!password_verify($password, $pass)) {
            return array('success' => false, 'msg' => "Uživatelské jméno nebo heslo není správné");
        }
        $token = uniqid('',true);
        Database::getInstance()->update(USERS_TABLE, array('token' => md5($token)), array('email' => $email));
        return array('success' => true, 'token' => $token);
    }

    public static function googleLogin($email, $id) {
        $google_id = Database::getInstance()->getValue(USERS_TABLE, "google_id", array('email' => $email));
        if ($google_id !== false) {
            if ($id == $google_id) {
                $token = uniqid('',true);
                Database::getInstance()->update(USERS_TABLE, array('token' => md5($token)), array('email' => $email));
                return array('success' => true, 'token' => $token);
            } else {
                return array('success' => false, 'exist' => true);
            }
        }
        return array('success' => false, 'exist' => false);
    }

    public static function isUserLoggedIn() {
        if (self::$logged_in == null) {
            if (isset($_COOKIE["user"])) {
                $result = Database::getInstance()->getValue(USERS_TABLE, 'id', array('token' => md5($_COOKIE["user"])));
                if ($result === false) {
                    setcookie("user", "", 0, getCookiePath());
                    unset($_COOKIE["user"]);
                    self::$logged_in_id = null;
                    self::$logged_in = false;
                    return self::$logged_in;
                }
                self::$logged_in_id = intval($result);
                self::$logged_in = true;
                return self::$logged_in;
            }
            self::$logged_in_id = null;
            self::$logged_in = false;
            return self::$logged_in;
        }
        return self::$logged_in;
    }

    public static function getCurrentUserId() {
        return self::$logged_in_id;
    }
}