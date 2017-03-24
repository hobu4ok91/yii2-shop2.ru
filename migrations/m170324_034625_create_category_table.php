<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 * Has foreign keys to the tables:
 *
 * - `category`
 */
class m170324_034625_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'name' => $this->string()->notNull(),
        ]);

        // creates index for column `parent_id`
        $this->createIndex(
            'idx-category-parent_id',
            'category',
            'parent_id'
        );


        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-category-parent_id',
            'category',
            'parent_id',
            'category',
            'id',
            'SET NULL',
            'RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-category-parent_id',
            'category'
        );

        // drops index for column `parent_id`
        $this->dropIndex(
            'idx-category-parent_id',
            'category'
        );

        $this->dropTable('category');
    }
}


