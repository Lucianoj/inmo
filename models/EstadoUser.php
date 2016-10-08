<?php

namespace app\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "estado_user".
 *
 * @property integer $id
 * @property string $estado_nombre
 * @property integer $estado_valor
 */
class EstadoUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'estado_nombre', 'estado_valor'], 'required'],
            [['id', 'estado_valor'], 'integer'],
            [['estado_nombre'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'estado_nombre' => Yii::t('app', 'Estado'),
            'estado_valor' => Yii::t('app', 'Valor de Estado'),
        ];
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['estado_id' => 'id']);
    }
}

