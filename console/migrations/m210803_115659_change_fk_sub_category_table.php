<?php

use yii\db\Migration;

/**
 * Class m210803_115659_change_fk_sub_category_table
 */
class m210803_115659_change_fk_sub_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey(
            'fk-category-subcategory',
            'sub_categories',
        );

        $this->addForeignKey(
            'fk-category-subcategory',
            'sub_categories',
            'category_id',
            'categories',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-category-subcategory',
            'sub_categories',
        );
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210803_115659_change_fk_sub_category_table cannot be reverted.\n";

        return false;
    }
    */
}
