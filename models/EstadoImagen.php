<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado_imagen".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Imagen[] $imagens
 */
class EstadoImagen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado_imagen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 45],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagens()
    {
        return $this->hasMany(Imagen::className(), ['estado_imagen_id' => 'id']);
    }
}
