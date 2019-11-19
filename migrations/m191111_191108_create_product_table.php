<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m191111_191108_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        //id integer(10)->unsigned()->notNull()->primaryKey();
        //category_id integer(10)->unsigned()->notNull();
        //name text(255)->notNull();
        //content text()->default(null);
        //price money()->notNull()-default(0);
        //keywords text(255)->default(null);
        //description text(255)->default(null);
        //img text(255)->default('no-image.png');
        //hit => $this->append('enum("0", "1")' . 'NOT NULL ' . 'DEFAULT 0')

        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(10)->notNull(),
            'category_id' => $this->integer(10)->notNull(),
            'name' => $this->string(255)->notNull(),
            'content' => $this->text()->defaultValue(null),
            'price' => $this->money()->notNull()->defaultValue(0),
            'keywords' => $this->string(255)->defaultValue(null),
            'description' => $this->string(255)->defaultValue(null),
            'img' => $this->string(255)->defaultValue('no-image.png'),
            'hit' => 'enum("0", "1")' . 'NOT NULL ' . 'DEFAULT "0"',
            'new' => 'enum("0", "1")' . 'NOT NULL ' . 'DEFAULT "0"',
            'sale' => 'enum("0", "1")' . 'NOT NULL ' . 'DEFAULT "0"',
        ]);
        $this->createIndex(
            'IDX_product_category_id',
            '{{%product}}',
            'category_id'
        );
        $this->addForeignKey(
            'FK_product_category_id',
            '{{%product}}',
            'category_id',
            '{{%category}}',
            'id'
        );
//        echo print_r($this, true);
//        die();


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
