<?php
  require "../config.php";

  function fetchUsers()
  {
    $users = [];
    $lines = file(DB_FILE_USERS);
    foreach ($lines as $line) {
      $line = trim($line);

      if (!$line) {
        continue;
      }

      $fields = explode(DELIMITER, $line);
      $users[$fields[1]] = [
        'first_name' => $fields[0],
        'last_name' => $fields[1],
        'gender' => $fields[2],
        'phone' => $fields[3],
        'avatar' => $fields[4],
        'card_pack' => $fields[5],
        'card_count' => $fields[6],
        'email' => $fields[7],
        'email_normalized' => $fields[8],
        'password' => $fields[9]
      ];
    }

    return $users;
  }

  function fetchUser($email)
  {
    $normalized = normalizeString($email);
    $lines = file(DB_FILE_USERS);
    foreach ($lines as $line) {
      $line = trim($line);

      if (!$line) {
        continue;
      }

      $fields = explode(DELIMITER, $line);
      if ($fields[8] === $normalized) {
        return [
          'first_name' => $fields[0],
          'last_name' => $fields[1],
          'gender' => $fields[2],
          'phone' => $fields[3],
          'avatar' => $fields[4],
          'card_pack' => $fields[5],
          'card_count' => $fields[6],
          'email' => $fields[7],
          'email_normalized' => $fields[8],
          'password' => $fields[9]
        ];
      }
    }

    return null;
  }

  function registerNewUser($user)
  {
    $users = fetchUsers();
    if (array_key_exists($user['email_normalized'], $users)) {
      return ['success' => false, 'message' => 'An account with this email already exists.'];
    }
    $userRecord =
      $user['first_name'] . DELIMITER .
      $user['last_name'] . DELIMITER .
      $user['gender'] . DELIMITER .
      $user['phone'] . DELIMITER .
      $user['avatar'] . DELIMITER .
      $user['card_pack'] . DELIMITER .
      $user['card_count'] . DELIMITER .
      $user['email'] . DELIMITER .
      normalizeString($user['email']) . DELIMITER .
      $user['password'] . "\r\n";

    file_put_contents(DB_FILE_USERS, $userRecord, FILE_APPEND);
    return ['success' => true, 'message' => 'Registration was successful'];
  }

  function authenticate($email, $password)
  {
    $user = fetchUser($email);

    if (!$user || $user['password'] !== $password) {
      return ['success' => false, 'message' => 'Wrong email or password'];
    }

    return ['success' => true, 'message' => 'Login success'];
  }

  function normalizeString($input) {
    return strtoupper($input);
  }
