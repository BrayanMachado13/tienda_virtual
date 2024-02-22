<?php
interface PasswordHasherInterface {
    public function hashPassword($password);
    public function verifyPassword($password, $hashedPassword);
}
?>