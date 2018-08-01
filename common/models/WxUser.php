<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wxuser".
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property int $is_admin
 */
class WxUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wxuser';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_admin'], 'integer'],
            [['uuid', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => 'OpenID',
            'name' => '姓名',
            'is_admin' => '管理员',
        ];
    }

    public function getNameOrOpenid(){
        if($this->name){
            return $this->name;
        }
        return $this->uuid;
    }
}
