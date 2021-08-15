<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sub_orders}}`.
 */
class m210810_102928_create_sub_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sub_orders}}', [
            'id' => $this->primaryKey(),
            'count'=> $this->integer()->notNull()->defaultValue(1),
            'product_id'=>$this->integer()->notNull(), 
            'order_id'=>$this->integer()->notNull(), 
        ]);

        $this->createIndex(
            'idx_order',
            'sub_orders',
            'order_id'
        );

        $this->createIndex(
            'idx_product',
            'sub_orders',
            'product_id'
        );

        $this->addForeignKey(
            'fk-order',
            'sub_orders',
            'order_id',
            'orders',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-product',
            'sub_orders',
            'product_id',
            'products',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sub_orders}}');

        $this->dropIndex(
            'idx_order',
            'sub_orders',
        );

        $this->dropForeignKey(
            'fk-order',
            'sub_orders'
        );

        $this->dropIndex(
            'idx_product',
            'sub_orders',
        );

        $this->dropForeignKey(
            'fk-procduct',
            'sub_orders'
        );
    }
}
