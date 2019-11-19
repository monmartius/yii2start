<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_items}}`.
 */
class m191117_135059_create_order_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_items}}', [
            'id' => $this->primaryKey(10)->notNull(),
            'order_id' => $this->integer(10)->notNull(),
            'product_id' => $this->integer(10)->notNull(),
            'name' => $this->string(255)->notNull(),
            'price' => $this->money()->notNull(),
            'qty_item' => $this->integer(11)->notNull(),
            'sum_item' => $this->money()->notNull()
        ]);

        $this->addForeignKey(
            'FK_order_items_order_id',
            '{{%order_items}}',
            'order_id',
            '{{%order}}',
            'id'
        );

        $this->addForeignKey(
            'FK_order_items_product_id',
            '{{%order_items}}',
            'product_id',
            '{{%product}}',
            'id'
        );

//        echo print_r($this, true);
//        die();

//
//        $this->addForeignKey(
//            'fk-order-items-to-order_id',  // это "условное имя" ключа
//            '{{%order_items}}', // это название текущей таблицы
//            'order_id', // это имя поля в текущей таблице, которое будет ключом
//            'order', // это имя таблицы, с которой хотим связаться
//            'id', // это поле таблицы, с которым хотим связаться
//            'CASCADE'
//        );
//        $this->addForeignKey(
//            'fk-order-items-to-product',  // это "условное имя" ключа
//            '{{%order_items}}', // это название текущей таблицы
//            'product_id', // это имя поля в текущей таблице, которое будет ключом
//            'product', // это имя таблицы, с которой хотим связаться
//            'id', // это поле таблицы, с которым хотим связаться
//            'CASCADE'
//        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_items}}');
    }
}
