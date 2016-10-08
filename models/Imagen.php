<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imagen".
 *
 * @property integer $id
 * @property integer $inmueble_id
 * @property integer $estado_imagen_id
 * @property string $nombre
 * @property string $ruta
 * @property string $subtitulo
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property Inmueble $inmueble
 * @property User $updatedBy
 * @property User $createdBy
 * @property EstadoImagen $estadoImagen
 */
class Imagen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'imagen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inmueble_id', 'nombre', 'ruta', 'created_by', 'updated_by'], 'required'],
            [['inmueble_id', 'estado_imagen_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 45],
            [['ruta', 'subtitulo'], 'string', 'max' => 100],
            [['inmueble_id'], 'exist', 'skipOnError' => true, 'targetClass' => Inmueble::className(), 'targetAttribute' => ['inmueble_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['estado_imagen_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoImagen::className(), 'targetAttribute' => ['estado_imagen_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'inmueble_id' => 'Inmueble ID',
            'estado_imagen_id' => 'Estado Imagen ID',
            'nombre' => 'Nombre',
            'ruta' => 'Ruta',
            'subtitulo' => 'Subtitulo',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInmueble()
    {
        return $this->hasOne(Inmueble::className(), ['id' => 'inmueble_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoImagen()
    {
        return $this->hasOne(EstadoImagen::className(), ['id' => 'estado_imagen_id']);
    }
}
