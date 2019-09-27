<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Procurement;

/**
 * ProcurementSearch represents the model behind the search form of `common\models\Procurement`.
 */
class ProcurementSearch extends Procurement
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['procurement_id', 'procurement_owner', 'procurement_status'], 'integer'],
            [['procurement_creation_date', 'procurement_contract', 'procurement_request', 'shipment_start_date', 'shipment_end_date', 'procurement_tender'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Procurement::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'procurement_id' => $this->procurement_id,
            'procurement_creation_date' => $this->procurement_creation_date,
            'procurement_owner' => $this->procurement_owner,
            'procurement_status' => $this->procurement_status,
            'shipment_start_date' => $this->shipment_start_date,
            'shipment_end_date' => $this->shipment_end_date,
        ]);

        $query->andFilterWhere(['like', 'procurement_contract', $this->procurement_contract])
            ->andFilterWhere(['like', 'procurement_request', $this->procurement_request])
            ->andFilterWhere(['like', 'procurement_tender', $this->procurement_tender]);

        return $dataProvider;
    }
}
