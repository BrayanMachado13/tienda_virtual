<?php
// password_hasher.php
require_once '../interfaces/password_hasher_interface.php';

class PasswordHasher implements PasswordHasherInterface {
    public function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyPassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }
}
?>
