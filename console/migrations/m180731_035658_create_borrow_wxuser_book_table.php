<?php

use yii\db\Migration;

/**
 * Handles the creation of table `borrow_wxuser_book`.
 */
class m180731_035658_create_borrow_wxuser_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('borrow_wxuser_book', [
            'id' => $this->primaryKey(),
            'wxuser_id' => $this->integer(),
            'book_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('borrow_wxuser_book');
    }
}
