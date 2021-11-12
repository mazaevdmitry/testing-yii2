<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "obj_properties".
 *
 * @property int $id
 * @property int $obj_id
 * @property int $type_id
 * @property string $value
 *
 * @property ObjList $obj
 * @property ObjTypeProperties $type
 */
class ObjProperties extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'obj_properties';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['obj_id', 'type_id', 'value'], 'required'],
            [['obj_id', 'type_id'], 'integer'],
            [['value'], 'string', 'max' => 50],
            [['obj_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjList::className(), 'targetAttribute' => ['obj_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjTypeProperties::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'obj_id' => 'Obj ID',
            'type_id' => 'Type ID',
            'value' => 'Value',
        ];
    }

    /**
     * Gets query for [[Obj]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObj()
    {
        return $this->hasOne(ObjList::className(), ['id' => 'obj_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ObjTypeProperties::className(), ['id' => 'type_id']);
    }
}
