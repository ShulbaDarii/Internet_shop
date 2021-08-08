<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m210803_113730_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'name'=> $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'count'=> $this->integer()->notNull()->defaultValue(0),
            'price'=>$this->float()->notNull()->defaultValue(0),
            'category_id'=>$this->integer()->notNull(),
            'sub_category_id'=>$this->integer()->notNull(),
            'url_images'=>'json'
        ]);
        
        $this->createIndex(
            'idx_sub_category',
            'products',
            'sub_category_id'
        );
        $this->createIndex(
            'idx_category',
            'products',
            'category_id'
        );
        $this->addForeignKey(
            'fk-category-products',
            'products',
            'category_id',
            'categories',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-sub_category-products',
            'products',
            'category_id',
            'sub_categories',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');

        $this->dropIndex(
            'idx_sub_category',
            'products',
        );
        $this->dropIndex(
            'idx_category',
            'sub_categories',
        );
        $this->dropForeignKey(
            'fk-category-products',
            'products'
        );
        $this->dropForeignKey(
            'fk-sub_category-products',
            'products'
        );
    }
}
