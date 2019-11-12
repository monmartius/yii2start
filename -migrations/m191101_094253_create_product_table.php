<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m191101_094253_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%product}}', [

            'id' => $this->integer(10),

            'category_id' => $this->integer(10)->unsigned()->notNull()->defaultValue(0),

            'name' => $this->text(255)->notNull(),

            'content' => $this->text()->defaultValue(null),

            'price' => $this->money()->notNull()->defaultValue(0),

            'keywords' => $this->text(255)->defaultValue(null),

            'description' => $this->text(255)->defaultValue(null),

              'img' => $this->text(255)->defaultValue('no-image.png'),

            'hit' => $this->text()->defaultValue('0'),

            'new' => $this->text()->defaultValue('0'),

            'sale' => $this->text()->defaultValue('0'),

        ]);

        $this->addPrimaryKey('productId', 'product', 'id');

        $this->addForeignKey('categoryId', 'product', 'category_id', 'category', 'id');

        echo print_r($this);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
