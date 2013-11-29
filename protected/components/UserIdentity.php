<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = Users::model()->find('login = :login', array(':login' => $this->username));
		if($user === NULL)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		elseif(!$user->validatePassword($this->password))
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
        else
        {

            $hash = UsersRegistryHash::model()->find('user=:user',array(
                ':user'=>$user->id
            ));

            if(is_null($hash))
            {
                $this->errorCode = self::ERROR_NONE;
                $this->setState('id', $user->id);
            }

            else
                return 8;

        }

		return !$this->errorCode;
	}
}
