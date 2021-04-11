<?php

/** 
 * Sends email
 * 
 * @param string $recipient
 * @param string $subject
 * @param string $message
 * @return boolean if the email was sent successfuly
*/
function sendEmail($recipient, $subject, $message) {
    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html, charset=utf-8',
        'From: app@dev.com',
        'Reply-To: app@dev.com',
        'X-Mailer: PHP/8.0',
    ];
    $msg = "
        <h1>Registration confirmation</h1>
        <p>$message</p>
    ";
    return mail($recipient, $subject, $msg, implode("\r\n", $headers));
  }
  
  /** 
   * Creates an array of all the users from specific database
   * 
   * @param string $databaseFileName
   * @return array array of all the users in the  database 
  */
  function getUsers($databaseFileName = './users.db') {
    
    $lines = file($databaseFileName);

    $users = [];
    
    foreach ($lines as $line) {
      if (!$line) {
        continue;
      }
      
      $fields = explode("\t", $line);

      $name = str_replace(array(' ', "\n", "\t", "\r"), '', $fields[0]);
      $email = str_replace(array(' ', "\n", "\t", "\r"), '', $fields[1]);
      $password = str_replace(array(' ', "\n", "\t", "\r"), '', $fields[2]);
      
      $users[$email] = [
        "name" => $name,
        "password" => $password
      ];
    }

    return $users;
  }

  /** 
   * Gets user based on his/her identifier from specific database
   * 
   * @param string $identifier
   * @param string $databaseFileName
   * @return array|false data of specific user or false when
   *                     there are duplicates or no data at all
  */
  function getUser($identifier, $databaseFileName = './users.db') {

    $users = getUsers($databaseFileName);
    $dataBox = [];
    $error = -1;
    foreach ($users as $user => $data) {
      if ($identifier === $user) {
        array_push($dataBox, $data);
        $error++;
      }
    }
    
    if ($error) {
      return null;
    }

    return $dataBox[0];
  }

  /** 
   * Checks for duplicate users based on the identifier from specific database
   * 
   * @param array $data - name, email and password are required
   * @param string $databaseFileName
   * @return void 
  */
  function makeRegistration($data, $databaseFileName = './users.db') {
    
    $userInformation = [
      $data['name'],
      $data['email'],
      $data['password'],
    ];

    // vyrobit zaznam ve stringu
    $newRecord = implode("\t", $userInformation) . "\r\n";

    // vlozit do souboru
    file_put_contents($databaseFileName, $newRecord, FILE_APPEND);
                
  }