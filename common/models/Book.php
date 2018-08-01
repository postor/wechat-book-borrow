<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $add_time
 * @property int $borrowed
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['add_time'], 'safe'],
            [['borrowed'], 'integer'],
            [['name', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
            'add_time' => 'Add Time',
            'borrowed' => 'Borrowed',
        ];
    }

    public function getBorrows()
    {
        return $this->hasMany(BorrowWxuserBook::className(), ['book_id' => 'id']);
    }

    public function getCurrentBorrow()
    {
        return $this->hasOne(BorrowWxuserBook::className(), ['id' => 'borrowed']);
    }

    /**
     * @return WxUser
     */
    public function getBorrowUser()
    {
        $borrow = $this->currentBorrow;
        if (!$borrow) {
            return false;
        }
        return $borrow->user;
    }


    public static function getOverDueQuery()
    {
        self::find()
            ->joinWith('currentBorrow')
            ->where(['>', 'borrowed', 0])
            ->orderBy('borrow_time asc');
    }
}
