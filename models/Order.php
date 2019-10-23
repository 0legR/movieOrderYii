<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $seance
 * @property int $total_price
 * @property string $seats
 * @property string $created_at
 * @property string $updated_at
 */
class Order extends \yii\db\ActiveRecord
{
    const BOOKING_PRICE = 3;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'seance', 'total_price', 'seats'], 'required'],
            [['user_id', 'seance', 'total_price'], 'integer'],
            [['seats'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'seance' => 'Seance',
            'total_price' => 'Total Price',
            'seats' => 'Seats',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    /**
     * count total price
     * @param $price of on seat
     * @param $isBookOnly 
     */
    public function countTotalPrice($price, $isBookOnly = false)
    {
        $rowsArray = json_decode($this->seats);
        $seatConter = 0;
        foreach ($rowsArray as $key => $row) {
            $seatConter += count($row);
        }
        $priceToCount = $isBookOnly ? self::BOOKING_PRICE : $price;
        $this->total_price = $seatConter * $priceToCount;
    }
}
