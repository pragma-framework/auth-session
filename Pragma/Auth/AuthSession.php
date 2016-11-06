<?php
namespace Pragma\Auth;

class AuthSession{
	public static function hashgen($pwd){
		return password_hash($pwd, PASSWORD_BCRYPT, ['cost' => defined('AUTH_CRYPTO_COST') ? AUTH_CRYPTO_COST : 10]);
	}

	public static function check_password($pwd, $hash){
		return password_verify($pwd, $hash);
	}

	public static function register_session($u){
		if(is_subclass_of($u, 'Pragma\ORM\Model')){
			if(defined('AUTH_USER_MODEL') && get_class($u) == AUTH_USER_MODEL){
				if(isset($_SESSION['user'])) unset($_SESSION['user']);
				$_SESSION['user'] = $u->as_array();
			}
			else{
				throw new AuthSessionException(AuthSessionException::UNKNOWN_USER_MODEL);
			}
		}
		else{
			throw new AuthSessionException(AuthSessionException::NOT_INSTANCE_OF_CORE_MODEL);
		}
	}

	public static function signed_in(){
		return !empty($_SESSION['user']);
	}

	public static function get_signed_user(){
		if(self::signed_in()){
			if(defined('AUTH_USER_MODEL') && class_exists(AUTH_USER_MODEL)){
				$classname = AUTH_USER_MODEL;
				$u = $classname::find($_SESSION['user']['id']);
				return $u;
			}
			else{
				throw new AuthSessionException(AuthSessionException::UNKNOWN_USER_MODEL);
			}
		}
		else return null;
	}

	public static function destroy_session(){
		unset($_SESSION['user']);
	}
}
