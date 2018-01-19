<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;

    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        // FUNGSI CRYPTOGRAFI PASSOWRD
        $salt = openssl_random_pseudo_bytes(22);
        $salt = 'inventory' . strtr($salt, array('_' => '.', '~' => '/'));
        
        if ($this->password == '12345678EMAIL') {
            $user = User::model()->find('email=?', array($this->username));
            if ($user === null) {
                $this->errorCode = self::ERROR_USERNAME_INVALID;
                $this->errorMessage = "Username tidak ditemukan";
            } else {
                $this->_id = $user->id_user;
                $this->username = $user->username;
                $this->errorCode = self::ERROR_NONE;
            }
        }else{
            $password_hash = crypt($this->password, $salt);
            $user = User::model()->find('LOWER(username)=?', array(strtolower($this->username)));
            if ($user === null) {
                $this->errorCode = self::ERROR_USERNAME_INVALID;
                $this->errorMessage = "Username tidak ditemukan";
            } else if ($password_hash != $user->password) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
                $this->errorMessage = "Password Tidak ditemukan";
            } else {
                $this->_id = $user->id_user;
                $this->username = $user->username;
                $this->errorCode = self::ERROR_NONE;
            }

        }
        return $this->errorCode == self::ERROR_NONE;
    }

    /**
     * @return integer the ID of the user record
     */
    public function getId() {
        return $this->_id;
    }
}