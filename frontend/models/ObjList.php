<?php

namespace frontend\models;


class ObjList extends \common\models\ObjList
{
    public function fields()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'id',
            'name',
            'created_at',
            'properties' => function($model) {
                /* @var $model \common\models\ObjList */
                $prop = [];
                foreach ($model->objProperties as $props) {

                    switch ($props->type->data_type) {
                        case 1:
                            $value = (int)$props->value;
                            break;
                        case 2:
                            $value = (string)$props->value;
                            break;
                        case 3:
                            $value = (bool)$props->value;
                            break;
                        default:
                            $value = (string)$props->value;
                    }

                    $prop[] = [
                        'id' => $props->id,
                        'name' => $props->type->name,
                        'value' => $value,
                    ];
                }
                return $prop;
            }
        ];
    }

    public function extraFields()
    {
        return [];
    }
}
