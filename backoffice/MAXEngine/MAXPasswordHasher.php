<?php

class MAXPasswordHasher
{
    public const ROUNDS = 13;

    /**
     * Hash the provided password.
     *
     * @param $password
     * @return string
     */
    public function hashPassword($password): string
    {
        return password_hash($password, PASSWORD_BCRYPT, [
            'cost' => self::ROUNDS,
        ]);
    }
}
