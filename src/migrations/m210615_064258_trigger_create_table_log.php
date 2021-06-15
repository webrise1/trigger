<?php

use yii\db\Migration;

/**
 * Class m210615_064258_trigger_create_table_log
 */
class m210615_064258_trigger_create_table_log extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ext_triggers_log}}', [
            'id' => $this->primaryKey(),
            'trigger_id' => $this->integer(),
            'message' => $this->text(),
            'status' => $this->tinyInteger()->defaultValue(1),
            'trigger_code' => $this->string(255)->null(),
            'created_at' => 'datetime DEFAULT NOW()',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ext_triggers_log}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210615_064258_trigger_create_table_log cannot be reverted.\n";

        return false;
    }
    */
}
