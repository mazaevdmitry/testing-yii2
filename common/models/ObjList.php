<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "obj_list".
 *
 * @property int $id
 * @property string $name
 * @property int $type_id
 * @property string $created_at
 *
 * @property ObjProperties[] $objProperties
 * @property ObjType $type
 */
class ObjList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'obj_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type_id'], 'required'],
            [['type_id'], 'integer'],
            [['created_at'], 'safe'],
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
            'name' => 'Name',
            'type_id' => 'Type ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[ObjProperties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjProperties()
    {
        return $this->hasMany(ObjProperties::className(), ['obj_id' => 'id']);
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
