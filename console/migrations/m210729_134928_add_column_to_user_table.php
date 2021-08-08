<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m210729_134928_add_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}','first_name',$this->string()->notNull()->after('id'));
        $this->addColumn('{{%user}}','second_name',$this->string()->notNull()->after('first_name'));
        $this->addColumn('{{%user}}','last_name',$this->string()->notNull()->after('second_name'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}','first_name');
        $this->dropColumn('{{%user}}','second_name');
        $this->dropColumn('{{%user}}','last_name');
    }
}
