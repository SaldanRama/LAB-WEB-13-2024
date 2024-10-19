<?php
session_start();

$users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
    ],
    [
        'email' => 'nanda@gmail.com',
        'username' => 'nanda_aja',
        'name' => 'Wd. Ananda Lesmono',
        'password' => password_hash('nanda123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'MIPA',
        'batch' => '2021',
    ],
    [
        'email' => 'arif@gmail.com',
        'username' => 'arif_nich',
        'name' => 'Muhammad Arief',
        'password' => password_hash('arief123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Hukum',
        'batch' => '2021',
    ],
    [
        'email' => 'eka@gmail.com',
        'username' => 'eka59',
        'name' => 'Eka Hanny',
        'password' => password_hash('eka123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'Keperawatan',
        'batch' => '2021',
    ],
    [
        'email' => 'adnan@gmail.com',
        'username' => 'adnan72',
        'name' => 'Adnan',
        'password' => password_hash('adnan123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Teknik',
        'batch' => '2020',
    ],
];

function authenticate($email_or_username, $password) {
    global $users;
    foreach ($users as $user) {
        if (($user['email'] === $email_or_username || $user['username'] === $email_or_username) && password_verify($password, $user['password'])) {
            return $user;
        }
    }
    return null;
}

function is_admin($user) {
    return $user['email'] === 'admin@gmail.com';
}
?>