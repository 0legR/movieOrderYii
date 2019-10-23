<?php

namespace app\modules\api\components;

use Yii;
use yii\filters\auth\HttpBasicAuth;

class ApiAuth extends HttpBasicAuth
{
    public function authenticate($user, $request, $response)
    {
        $headers = $request->getHeaders();
        $token = $headers['access_token'];
        if ($token) {
            $identity = $user->loginByAccessToken($token, get_class($this));
            if ($identity === null) {
                $this->handleFailure($response);
            }
            return $identity;
        }
        return null;
    }

    public function login($user)
    {
        Yii::$app->user->login($user);
    }

    public function logout()
    {
        Yii::$app->user->logout();
    }
}