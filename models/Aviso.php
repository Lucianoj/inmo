<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aviso".
 *
 * @property integer $id
 * @property integer $tipo_aviso_id
 * @property integer $estado_aviso_id
 * @property integer $created_by
 * @property string $titulo
 * @property integer $inmueble_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property User $updatedBy
 * @property User $createdBy
 * @property TipoAviso $tipoAviso
 * @property EstadoAviso $estadoAviso
 * @property Inmueble $inmueble
 */
class Aviso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aviso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_aviso_id', 'estado_aviso_id', 'created_by', 'titulo', 'inmueble_id', 'updated_by'], 'required'],
            [['tipo_aviso_id', 'estado_aviso_id', 'created_by', 'inmueble_id', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['titulo'], 'string', 'max' => 100],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['tipo_aviso_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoAviso::className(), 'targetAttribute' => ['tipo_aviso_id' => 'id']],
            [['estado_aviso_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoAviso::className(), 'targetAttribute' => ['estado_aviso_id' => 'id']],
            [['inmueble_id'], 'exist', 'skipOnError' => true, 'targetClass' => Inmueble::className(), 'targetAttribute' => ['inmueble_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo_aviso_id' => 'Tipo Aviso ID',
            'estado_aviso_id' => 'Estado Aviso ID',
            'created_by' => 'Created By',
            'titulo' => 'Titulo',
            'inmueble_id' => 'Inmueble ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
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
    public function getTipoAviso()
    {
        return $this->hasOne(TipoAviso::className(), ['id' => 'tipo_aviso_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoAviso()
    {
        return $this->hasOne(EstadoAviso::className(), ['id' => 'estado_aviso_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInmueble()
    {
        return $this->hasOne(Inmueble::className(), ['id' => 'inmueble_id']);
    }
}
