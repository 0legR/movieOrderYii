#Test task Order Seats

###migration
1. to seed hall_seven table => use command yii seed-table-hall-seven
1. to add Admin to user table => use command yii create-user-admin
1. admin login => movie.test@gmail.com and pass => admin

###API
	

	/**
	 * @api {get} /api/seance/movie Request Seance information
	 * @apiName GetSeance
	 * @apiGroup Seance
	 *
	 * @apiParam {Number} id Seance unique ID.
	 *
	 * @apiSuccess {Object} 
	 * @apiSuccessExample Success-Response:
	 *  {
	 *    data: {
	 *      seance: {
	 *          id: 1
	 *          movie: 'some movie'
	 *          date_time: '2019-11-11 11:11:11'
	 *          price: 23
	 *          hall: 1
	 *      },
	 *      seats: [
	 *        {
	 *           id: 1,
	 *           row: 1,
	 *           seat: 1,
	 *           is_free: 1,
	 *           seance: 1,
	 *        },
	 *        {
	 *           id: 2,
	 *           row: 1,
	 *           seat: 2,
	 *           seance: 1,
	 *         }, 
	 *         ... 
	 *      ]
	 *    },
	 *    status: 200
	 *  }
	 *
	 * @apiError SeanceNotFound The id of the Seance was not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 404 Not Found
	 *     {
	 *       "error": "There isn't seance according to your request"
	 *     }
	 */

	 /**
	 * @api {post} api/order/store Store Order data
	 * @apiName CreateOrder
	 * @apiGroup Order
	 *
	 * @apiParam {
	 *	 	email: 'qwe@.asdf.df',
	 *	 	seance: 1,
	 *	 	rows: {"4":[5,6], "8":[3,4,5]},
	 *	 	isBookOnly: true
	 * 	} data to create Order.
	 *
	 * @apiSuccess {Object} 
	 * @apiSuccessExample Success-Response:
	 *  {
	 *    data: 'success',
	 *    status: 200
	 *  }
	 *
	 * @apiError SeanceNotFound The id of the Seance was not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 404 Not Found
	 *     {
	 *       "error": "Your order isn`t created"
	 *     }
	 */
