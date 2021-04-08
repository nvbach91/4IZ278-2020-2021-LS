<?php
function fetchUser($email)
{
    foreach (fetchUsers() as $user) {
        if ($user['email'] === $email) {
            return $user;
        }
    }
    return null;
};
