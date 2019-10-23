<?php
namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use app\models\Seances;
use app\modules\api\components\HallService;
use app\modules\api\components\ApiAuth;
use yii\filters\AccessControl;

/**
 * CRUD Seance Table
 */
class SeanceController extends Controller
{
	
	public function behaviors()
	{
		return [
			'authenticator' => [
				'class' => ApiAuth::className(),
				'except' => ['movie']
			],
			'access' => [
                'class' => AccessControl::className(),
                'only' => ['store', 'update', 'destroy'],
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
		            'movie' => ['get'],
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
	 * @param $id integer
	 * @return $seance object to json
	 */
	public function actionMovie()
	{
		$id = Yii::$app->request->get();
		$seance = Seances::findOne($id);
		if ($seance) {
			$hallService = new HallService($seance->hall);
			return [
				'data' => [
					'seance' => $seance,
					'seats' => $hallService->hallSeats()
				],
				'status' => 200
			];
		}
		return [
			'error' => 'There isn`t seance according to your request',
			'status' => 404
		];
	}
}