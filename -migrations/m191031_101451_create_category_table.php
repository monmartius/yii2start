<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m191031_101451_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [

            'id' => $this->integer(10),

            'parent_id' => $this->integer(10)-> unsigned()->notNull()->defaultValue(0),

            'name' => $this->text(255)->notNull(),

            'keywords' => $this->text(255)->defaultValue(null),

            'description' => $this->text(255)->defaultValue(null),


        ]);

//        $this->addPrimaryKey('categotyId', 'category', 'id');

        echo print_r($this);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
