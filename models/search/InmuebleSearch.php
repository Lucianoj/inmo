<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inmueble;

/**
 * InmuebleSearch represents the model behind the search form about `app\models\Inmueble`.
 */
class InmuebleSearch extends Inmueble
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipo_inmueble_id', 'cantidad_habitaciones', 'tiene_garage'], 'integer'],
            [['nombre', 'direccion'], 'safe'],
            [['latitud', 'longitud'], 'number'],
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
        $query = Inmueble::find();

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
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'tipo_inmueble_id' => $this->tipo_inmueble_id,
            'cantidad_habitaciones' => $this->cantidad_habitaciones,
            'tiene_garage' => $this->tiene_garage,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'direccion', $this->direccion]);

        return $dataProvider;
    }
}
