<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "procurement".
 *
 * @property int $procurement_id
 * @property string $procurement_creation_date
 * @property int $procurement_owner
 * @property int $procurement_status
 * @property string $procurement_contract
 * @property string $procurement_request
 * @property string $shipment_start_date
 * @property string $shipment_end_date
 * @property string $procurement_tender
 *
 * @property User $procurementOwner
 */
class Procurement extends \yii\db\ActiveRecord
{
    const STATUS_PLANNED_FOR_EXECUTION = 1;
    const STATUS_BIDDING = 2;
    const STATUS_DECISION_MAKING = 3;
    const STATUS_IN_PROGRESS = 4;
    const STATUS_PROCUREMENT_COMPLETED = 4;
    const STATUS_CANCELLED = 5;
    const STATUS_ARCHIVED = 6;
    const STATUS_DELETED = 7;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'procurement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['procurement_creation_date', 'shipment_start_date', 'shipment_end_date'], 'safe'],
            [['procurement_owner', 'procurement_status'], 'integer'],
            [['procurement_request', 'shipment_start_date', 'shipment_end_date'], 'required'],
            [['procurement_contract', 'procurement_request', 'procurement_tender'], 'string', 'max' => 255],
            [['procurement_owner'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['procurement_owner' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'procurement_id' => 'Procurement ID',
            'procurement_creation_date' => 'Procurement Creation Date',
            'procurement_owner' => 'Procurement Owner',
            'procurement_status' => 'Procurement Status',
            'procurement_contract' => 'Procurement Contract',
            'procurement_request' => 'Procurement Request',
            'shipment_start_date' => 'Shipment Start Date',
            'shipment_end_date' => 'Shipment End Date',
            'procurement_tender' => 'Procurement Tender',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'procurement_owner']);
    }
}
