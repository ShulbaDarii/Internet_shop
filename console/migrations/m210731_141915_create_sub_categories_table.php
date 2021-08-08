<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sub_categories}}`.
 */
class m210731_141915_create_sub_categories_table extends Migration
{
   /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sub_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);
        $this->createIndex(
            'idx_category',
            'sub_categories',
            'category_id'
        );
        $this->addForeignKey(
            'fk-category-subcategory',
            'sub_categories',
            'category_id',
            'categories',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-category-subcategory',
            'sub-categories'
        );
        $this->dropIndex(
            'idx_category',
            'sub_categories'
        );
        $this->dropTable('{{%sub_categories}}');
    }
}
