<?php
namespace Pragma\Auth;

class AuthSessionException extends \Exception{
	const UNKNOWN_USER_MODEL = '1 - UNKNOWN_USER_MODEL';
	const NOT_INSTANCE_OF_CORE_MODEL = '2 - NOT_INSTANCE_OF_CORE_MODEL';

	public function __constructor($code = 0, \Exception $previous = null){
		$message = "AuthSessionException : unknown error";
		switch ($code) {
			case self::UNKNOWN_USER_MODEL:
				$message = "User Model undefined or not valid. Please check your config.php and ensure that you defined AUTH_USER_MODEL constant";
				break;
			case self::NOT_INSTANCE_OF_CORE_MODEL:
				$message = "AUTH_USER_MODEL should be an instance of Pragma\ORM\Model";
				break;
		}
		parent::__constructor($message, $code, $previous);
	}

	public function __toString(){
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}
}
