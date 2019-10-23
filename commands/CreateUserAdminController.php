<?php

namespace app\commands;

use yii\console\ExitCode;
use app\models\User;
use yii\base\ErrorException;
use yii\console\Controller;
use yii\base\Exception;

class CreateUserAdminController extends Controller
{
    public function actionIndex()
    {
		try{
    		$this->addAdmin();	
    	} catch(ErrorException $e) {
    		echo $e . ExitCode::DATAERR;
    	}
        echo 'Success ' . ExitCode::OK;
    }

    private function addAdmin()
    {
    	$user = User::find()->where(['role' => User::ADMIN])->one();
    	if (empty($user)) {
    		$user = new User();
			$user->email = 'oleg.rostov2018@gmail.com';
			$user->setPassword('admin');
			$user->role = User::ADMIN;
			$user->generateAuthKey();
			if($user->save()) {
				echo 'Success ' . ExitCode::OK;
				return true;
			} else {
				throw new Exception('User isn`t stored' . ExitCode::DATAERR);
			}
    	}
    	echo 'User with admin already exists' . ExitCode::DATAERR;
    }
}
