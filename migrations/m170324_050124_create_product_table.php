<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 * Has foreign keys to the tables:
 *
 * - `category`
 * Command: yii migrate/create create_product_table --fields=category_id:integer:foreignKey(category),name:string:notNull,content:text,price:decimal(10,2),active:smallInteger(1):notNull:defaultValue(0),status:smallInteger(1):defaultValue(1)
 */
class m170324_050124_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'content' => $this->text(),
            'price' => $this->decimal(10,2),
            'active' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'status' => $this->smallInteger(1)->defaultValue(1),
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-product-category_id',
            'product',
            'category_id'
        );
        $this->createIndex(
            'idx-product-active',
            'product',
            'active'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-product-category_id',
            'product',
            'category_id',
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
            'fk-product-category_id',
            'product'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-product-category_id',
            'product'
        );

        $this->dropTable('product');
    }
}
