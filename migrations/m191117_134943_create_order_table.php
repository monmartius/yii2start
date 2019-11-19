<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m191117_134943_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [

            'id' => $this->primaryKey(10)->notNull(),

            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'qty' => $this->integer(10)->notNull(),
            'sum' => $this->money()->notNull(),
            'status' => 'enum("0", "1")' . 'NOT NULL ' . 'DEFAULT "0"',
            'name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'phone' => $this->string(255)->notNull(),
            'address' => $this->string(255)->notNull()
        ]);

        $this->createIndex(
            'IDX_order_id',
            '{{%order}}',
            'id'
        );
//        echo print_r($this, true);
//        die();
//

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
