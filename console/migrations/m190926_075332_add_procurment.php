<?php

use yii\db\Migration;

/**
 * Class m190926_075332_add_procurment
 */
class m190926_075332_add_procurment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Procurement}}', [
            'procurement_id' => $this->primaryKey(),
            'procurement_creation_date' => $this->dateTime(),
            'procurement_owner' => $this->integer(),
            'procurement_status' => $this->integer(),
            'procurement_contract' => $this->string(255),
            'procurement_request' => $this->string()->notNull(),
            'shipment_start_date' => $this->dateTime()->notNull(),
            'shipment_end_date' => $this->dateTime()->notNull(),
            'procurement_tender' => $this->string(),
        ]);
        $this->addForeignKey('{{%fk-procurement_owner-user_id}}', '{{%Procurement}}', 'Procurement_owner', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Procurement}}');
    }

}
