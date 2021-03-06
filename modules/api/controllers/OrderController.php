<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use app\models\Order;
use yii\web\HttpException;
use app\modules\api\components\UserService;
use app\modules\api\components\ApiAuth;
use app\modules\api\components\HallService;
use app\models\Seances;

/**
 * CRUD Order table
 */
class OrderController extends Controller
{
	public function behaviors()
	{
		return [
			'authenticator' => [
				'class' => ApiAuth::className(),
				'except' => ['store']
			],
			'access' => [
                'class' => AccessControl::className(),
                'only' => ['update', 'destroy'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
			'verbs' => [
				'class' => VerbFilter::className(),
		        'actions' => [
		            'store' => ['post'],
		        ]
			],
			'contentNegotiator' => [
	            'class' => ContentNegotiator::className(),
	            'formats' => [
	                'application/json' => Response::FORMAT_JSON,
	            ],
	        ]
		];
	}
/**

 * Create and athorize user
 * Book ordered seats
 * Create order itself
 *
 * 	$postData an array
 *	 [
 *			'isBookOnly' => true | false
 *			'email' => 'test@sdf.fs',
 *			'rows' => '{ '1' => [2, 3], '2' => [5, 7] ... }'
 *			'seance' => 1
 *	 ]
 */
    public function actionStore()
    {
        $postData = Yii::$app->request->bodyParams;
        $isBookOnly = isset($postData['isBookOnly']) ? $postData['isBookOnly'] : false;
        if (empty($postData['email'])) {
        	throw new HttpException(404, "Email is absent");
        }
        // Create and athorize user
        $userService = new UserService();
        $user = $userService->getOrCreateUserByEmail($postData['email']);
        $auth = new ApiAuth();
        $auth->login($user);
        // Book ordered seats
        $seance = Seances::findOne($postData['seance']);
        $hallService = new HallService($seance->hall, $seance->id);
        $hallService->bookSeat($postData['rows']);
        // Create order itself
        $order = new Order();
        $order->seance = $seance->id;
        $order->seats = $postData['rows'];
        $order->user_id = $user->id;
        $order->countTotalPrice($seance->price, $isBookOnly);
        if ($order->save()) {
        	// TO DO Send email with order to User
        	return [
        		'data' => 'success',
        		'status' => 201
        	];
        }
        // unbook seats unless order isn`t created
        $hallService->rollbackSeats();
        throw new HttpException(404, "Your order isn`t created");
    }

}
