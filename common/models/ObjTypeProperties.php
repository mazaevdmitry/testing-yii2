<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "obj_type_properties".
 *
 * @property int $id
 * @property int $type_id
 * @property int $data_type
 * @property string $name
 *
 * @property ObjProperties[] $objProperties
 * @property ObjType $type
 */
class ObjTypeProperties extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'obj_type_properties';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'name'], 'required'],
            [['type_id', 'data_type'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Type ID',
            'data_type' => 'Data Type',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[ObjProperties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjProperties()
    {
        return $this->hasMany(ObjProperties::className(), ['type_id' => 'id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ObjType::className(), ['id' => 'type_id']);
    }
}
