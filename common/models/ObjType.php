<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "obj_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property ObjList[] $objLists
 * @property ObjTypeProperties[] $objTypeProperties
 */
class ObjType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'obj_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function fields()
    {
        return [
            'name',
        ];
    }

    /**
     * Gets query for [[ObjLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjLists()
    {
        return $this->hasMany(ObjList::className(), ['type_id' => 'id']);
    }

    /**
     * Gets query for [[ObjTypeProperties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjTypeProperties()
    {
        return $this->hasMany(ObjTypeProperties::className(), ['type_id' => 'id']);
    }
}
