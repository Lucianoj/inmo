<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EstadoUser;

/**
 * EstadoUserSearch represents the model behind the search form about `app\models\EstadoUser`.
 */
class EstadoUserSearch extends EstadoUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'estado_valor'], 'integer'],
            [['estado_nombre'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = EstadoUser::find();

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
            'id' => $this->id,
            'estado_valor' => $this->estado_valor,
        ]);

        $query->andFilterWhere(['like', 'estado_nombre', $this->estado_nombre]);

        return $dataProvider;
    }
}
