<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "borrow_wxuser_book".
 *
 * @property int $id
 * @property int $wxuser_id
 * @property int $book_id
 * @property string $borrow_time
 * @property string $return_time
 */
class BorrowWxuserBook extends \yii\db\ActiveRecord
{
    const BORROW_LIMIT_TIME = 1296000;//86400*15 （15天）

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'borrow_wxuser_book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wxuser_id', 'book_id'], 'integer'],
            [['borrow_time', 'return_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wxuser_id' => 'Wxuser ID',
            'book_id' => 'Book ID',
            'borrow_time' => 'Borrow Time',
            'return_time' => 'Return Time',
        ];
    }

    public function getUser(){
        return $this->hasOne(WxUser::className(),['id'=>'wxuser_id']);
    }

    public function getDueReturnTime(){
        return strtotime($this->borrow_time)+self::BORROW_LIMIT_TIME;
    }
}
