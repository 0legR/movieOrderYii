<?php

namespace app\modules\api\components;

use app\models\User;
use yii\base\Exception;

/**
 * Manage Simple User
 */
class UserService
{
	
	// function __construct(argument)
	// {
	// 	# code...
	// }

	/**
	 * @param $email string
	 * @return User $user
	 */
	public function createUserByEmail($email)
	{
		$user = new User();
		$user->email = $email;
		$user->setPassword('1111');
		$user->role = User::SIMPLE;
		$user->generateAuthKey();
		if($user->save()) {
			return $user;
		} else {
			throw new Exception('User isn`t stored' . ExitCode::DATAERR);
		}
	}

	/**
	 * @param $email string
	 * @return User $user
	 */
	public function getOrCreateUserByEmail($email)
	{
		$user = User::find()->where(['email' => $email])->one();
		if (empty($user)) {
			return $this->createUserByEmail($email);
		}
    	return $user;
	}
}