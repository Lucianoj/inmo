<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado_aviso".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $valor
 *
 * @property Aviso[] $avisos
 */
class EstadoAviso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado_aviso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'valor'], 'required'],
            [['valor'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['nombre'], 'unique'],
            [['valor'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'valor' => 'Valor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvisos()
    {
        return $this->hasMany(Aviso::className(), ['estado_aviso_id' => 'id']);
    }
}
