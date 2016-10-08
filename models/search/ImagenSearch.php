<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Imagen;

/**
 * ImagenSearch represents the model behind the search form about `app\models\Imagen`.
 */
class ImagenSearch extends Imagen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'inmueble_id', 'estado_imagen_id', 'created_by', 'updated_by'], 'integer'],
            [['nombre', 'ruta', 'subtitulo', 'created_at', 'updated_at'], 'safe'],
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
        $query = Imagen::find();

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
            'inmueble_id' => $this->inmueble_id,
            'estado_imagen_id' => $this->estado_imagen_id,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'ruta', $this->ruta])
            ->andFilterWhere(['like', 'subtitulo', $this->subtitulo]);

        return $dataProvider;
    }
}
