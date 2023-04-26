<?php

class MAXValidator
{
    /**
     * @var MAXDatabase Instance of ASDatabase class
     */
    private $db;

    /**
     * Class constructor
     * @param MAXDatabase $db
     */
    public function __construct(MAXDatabase $db)
    {
        $this->db = $db;
    }

    /**
     * Check if provided input is empty.
     * If input is string then it checks if it is empty string.
     * @param $input array|string Input to be checked.
     * @return bool TRUE if input is empty, FALSE otherwise.
     */
    public function isEmpty($input): bool
    {
        if (is_array($input)) {
            return empty($input);
        }

        return trim($input) == '';
    }

    /**
     * Check if provided string is longer than provided number of characters.
     *
     * @param string $string String to be checked.
     * @param int $numOfCharacters Number of characters for comparison.
     * @return bool TRUE if string is longer than provided number of characters, FALSE otherwise.
     */
    public function longerThan(String $string, int $numOfCharacters): bool
    {
        return mb_strlen($string) > $numOfCharacters;
    }

    /**
     * Check if email has valid format.
     *
     * @param string $email Email to be checked.
     * @return boolean TRUE if email has valid format, FALSE otherwise.
     */
    public function emailValid(string $email): bool
    {
        return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email);
    }

    /**
     * Check if provided username exists.
     *
     * @param $username string Username to be checked.
     * @return bool TRUE if username exist, FALSE otherwise.
     */
    public function usernameExist(string $username): bool
    {
        return $this->exist('as_users', 'username', $username);
    }

    /**
     * Check if provided email exists.
     *
     * @param $email string Email to be checked.
     * @return bool TRUE if email exist, FALSE otherwise.
     */
    public function emailExist(string $email): bool
    {
        return $this->exist('as_users', 'email', $email);
    }

    /**
     * Check if provided role exists.
     *
     * @param $role string Role to be checked.
     * @return bool TRUE if role exist, FALSE otherwise.
     */
    public function roleExist(string $role): bool
    {
        return $this->exist('as_user_roles', 'role', $role);
    }

    /**
     * Check if password reset key is valid.
     *
     * @param $key string Key to be validated.
     * @return  boolean TRUE if key is valid, FALSE otherwise
     */
    public function prKeyValid(string $key): bool
    {
        // since it is md5 hash, it has to be 32 characters long
        if (strlen($key) != 32) {
            return false;
        }

        $result = $this->db->select(
            'SELECT * FROM `as_users` WHERE `password_reset_key` = :k',
            ['k' => $key]
        );

        // if key doesn't exist in DB, or it somehow exists more than once, it is not valid key
        if (count($result) !== 1) {
            return false;
        }

        $result = $result[0];

        // check if key is already used
        if ($result['password_reset_confirmed'] == 'Y') {
            return false;
        }

        // check if key is expired
        $now = date('Y-m-d H:i:s');
        $requestedAt = $result['password_reset_timestamp'];

        return strtotime($now . ' -'.PASSWORD_RESET_KEY_LIFE.' minutes') <= strtotime($requestedAt);
    }

    public function confirmationKeyValid($key): bool
    {
        // since it is md5 hash, it has to be 32 characters long
        if (strlen($key) != 32) {
            return false;
        }

        $result = $this->db->select(
            "SELECT * FROM `as_users` WHERE `confirmation_key` = :k",
            ["k" => $key]
        );

        // Confirmation key is valid if we get only
        // one row returned from our query.
        return count($result) == 1;
    }

    /**
     * Check if provided value exist in provided database table and provided db column.
     *
     * @param $table string Database table
     * @param $column string Database column
     * @param $value string|int Column value
     * @return bool TRUE if value exist in given table and column, FALSE otherwise.
     */
    private function exist(string $table, string $column, $value): bool
    {
        $result = $this->db->select(
            "SELECT * FROM `$table` WHERE `$column` = :val",
            ['val' => $value]
        );

        return $result !== [];
    }
}
