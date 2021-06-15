<?php

use yii\db\Migration;

/**
 * Class m210615_064250_trigger_create_table_trigger
 */
class m210615_064250_trigger_create_table_trigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ext_triggers_trigger}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'function_name' => $this->string(255)->notNull(),
            'title' => $this->string(255)->notNull(),
            'status' => $this->tinyInteger()->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ext_triggers_trigger}}');
    }


}
