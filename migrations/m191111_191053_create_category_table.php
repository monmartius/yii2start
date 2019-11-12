<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 *
 * category



 *
 */
class m191111_191053_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

// id -> integer 10 -> unsigned -> not null -> not default -> autoincrement
// parent_id -> integer 10 -> unsigned -> not null -> default 0
// name -> varchat(255) -> not null
// keywords -> varchar(255) -> default null
// description -> varchar(255) -> default null

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(10),
            'parent_id' => $this->integer(10)->unsigned()->notNull()->defaultValue(0),
            'name' => $this->string(255)->notNull(),
            'keywords' => $this->string(255)->defaultValue(null),
            'description' => $this->string()->defaultValue(null)
        ]);

//        $this->createIndex('parent-id-idx', '{{%category'}}, )
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
