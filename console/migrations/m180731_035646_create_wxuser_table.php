<?php

use yii\db\Migration;

/**
 * Handles the creation of table `wxuser`.
 */
class m180731_035646_create_wxuser_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('wxuser', [
            'id' => $this->primaryKey(),
            'uuid' => $this->string(),
            'name' => $this->string(),
            'is_admin' => $this->boolean(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('wxuser');
    }
}
