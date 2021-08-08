<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%promotion}}`.
 */
class m210731_145857_add_column_to_promotion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%promotions}}','date_start', $this->string());
        $this->addColumn('{{%promotions}}','date_end', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%promotions}}','date_start');
        $this->dropColumn('{{%promotions}}','date_end');
    }
}
