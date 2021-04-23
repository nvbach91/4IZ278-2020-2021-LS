<?php
require_once __DIR__ . '/Database.php';

class UsersDB extends Database
{
    protected $tableName = 'users';

    public function fetchAll()
    {
        return $this->readData();
    }

    public function fetchBy($params)
    {
        if (isset($params['skip'])) {
            return $this->readData($params['where'], $params['skip']);
        } else {
            return $this->readData($params['where']);
        }
    }

    public function create($params)
    {
        $exists = $this->getValue('COUNT(email)', array('email' => $params['email']));

        if ($exists != 0) {
            return array('success' => false, 'msg' => 'Uživatel s tímto emailem již existuje');
        }

        $password = password_hash($params['password'], PASSWORD_DEFAULT);
        $success = $this->insertData(array('email' => $params['email'], 'password' => $password, 'privilege' => 1, 'ident' => uniqid()));

        if ($success) {
            return array('success' => true, 'msg' => 'Uživatel úspěšně vytvořen');
        }
        return array('success' => false, 'msg' => 'Vytvoření uživatele selhalo');

    }

    public function update($data, $where)
    {
        return $this->updateData($data, $where);
    }

    public function delete($params)
    {
        // TODO: Implement delete() method.
    }


}