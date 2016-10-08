<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inmueble".
 *
 * @property integer $id
 * @property string $nombre
 * @property double $latitud
 * @property double $longitud
 * @property integer $tipo_inmueble_id
 * @property string $direccion
 * @property integer $cantidad_habitaciones
 * @property integer $tiene_garage
 *
 * @property Aviso[] $avisos
 * @property Imagen[] $imagens
 * @property TipoInmueble $tipoInmueble
 */
class Inmueble extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inmueble';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'tipo_inmueble_id', 'direccion', 'cantidad_habitaciones', 'tiene_garage'], 'required'],
            [['latitud', 'longitud'], 'number'],
            [['tipo_inmueble_id', 'cantidad_habitaciones', 'tiene_garage'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['direccion'], 'string', 'max' => 255],
            [['tipo_inmueble_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoInmueble::className(), 'targetAttribute' => ['tipo_inmueble_id' => 'id']],
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
            'latitud' => 'Latitud',
            'longitud' => 'Longitud',
            'tipo_inmueble_id' => 'Tipo Inmueble ID',
            'direccion' => 'Direccion',
            'cantidad_habitaciones' => 'Cantidad Habitaciones',
            'tiene_garage' => 'Tiene Garage',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvisos()
    {
        return $this->hasMany(Aviso::className(), ['inmueble_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagens()
    {
        return $this->hasMany(Imagen::className(), ['inmueble_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoInmueble()
    {
        return $this->hasOne(TipoInmueble::className(), ['id' => 'tipo_inmueble_id']);
    }
}
