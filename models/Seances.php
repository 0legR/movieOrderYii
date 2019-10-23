<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%seances}}".
 *
 * @property int $id
 * @property string $movie
 * @property string $date_time
 * @property int $hall
 * @property int $price
 * @property string $created_at
 * @property string $updated_at
 */
class Seances extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%seances}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['movie', 'hall', 'price'], 'required'],
            [['date_time', 'created_at', 'updated_at'], 'safe'],
            [['hall', 'price'], 'integer'],
            [['movie'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'movie' => 'Movie',
            'date_time' => 'Date Time',
            'hall' => 'Hall',
            'price' => 'Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
