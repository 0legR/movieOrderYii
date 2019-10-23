<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%hall_seven}}".
 *
 * @property int $id
 * @property int $row
 * @property int $seat
 * @property int $seance
 * @property int $is_free
 * @property string $created_at
 * @property string $updated_at
 */
class HallSeven extends ActiveRecord implements IHall
{
    private $hallNumber = 7;
    public $seats = [12, 14, 15, 13, 13, 13, 13, 13, 13, 20];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%hall_seven}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['row', 'seat', 'seance'], 'required'],
            [['row', 'seat', 'seance', 'is_free'], 'integer'],
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
            'row' => 'Row',
            'seat' => 'Seat',
            'is_free' => 'Is Free',
            'seance' => 'Seance',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @param number of Hall
     * @return boolean
     */
    public function checkHall($hall)
    {
        return $this->hallNumber === (int) $hall;
    }

    /**
     * @param $seance int
     * @return $seats
     */
    public function seats($seance)
    {
        return self::find()->where(['seance' => $seance])->all();
    }

    /**
     * Remove records by seance
     * @param $seance
     */
    public function removeAllBySeance($seance)
    {
        self::deleteAll(['seance' => $seance]);
    }
}
