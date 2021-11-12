<?php

namespace frontend\controllers;


use common\models\ObjType;
use frontend\models\ObjList;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;


/**
 * Site controller
 */
class ObjectController extends ActiveController
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['http://127.0.0.1:8080', 'http://localhost:8080'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Request-Method' => ['GET', 'PUT', 'POST', 'DELETE', 'OPTIONS'],
                'Access-Control-Max-Age' => 1000,
                'Access-Control-Allow-Headers' => ['Origin', 'Content-Type', 'X-Auth-Token', 'Authorization']
            ],
        ];
        return $behaviors;
    }

    public $modelClass = ObjList::class;
}
