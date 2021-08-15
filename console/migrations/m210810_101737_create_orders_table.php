<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m210810_101737_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'description' => $this->text()->notNull(),
            'data' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'user_id'=>$this->integer()->notNull(),  
        ]);

        $this->createIndex(
            'idx_user',
            'orders',
            'user_id'
        );
        $this->addForeignKey(
            'fk-user',
            'orders',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');

        $this->dropIndex(
            'idx_user',
            'orders',
        );

        $this->dropForeignKey(
            'fk-user',
            'orders'
        );
    }
}
