<?php

use yii\db\Migration;

/**
 * Class m180731_041831_modify_borrow_wxuser_book
 */
class m180731_041831_modify_borrow_wxuser_book extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('borrow_wxuser_book','borrow_time',$this->dateTime());
        $this->addColumn('borrow_wxuser_book','return_time',$this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('borrow_wxuser_book','borrow_time',$this->dateTime());
        $this->dropColumn('borrow_wxuser_book','return_time',$this->dateTime());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180731_041831_modify_borrow_wxuser_book cannot be reverted.\n";

        return false;
    }
    */
}
