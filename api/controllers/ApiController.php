<?php
namespace api\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\base\ErrorException;
use yii\web\ForbiddenHttpException;
use yii\web\Controller;
use common\models\Clients;
use common\models\Bonuses;

/**
 * Api controller
 */
class ApiController extends Controller
{

    public function actionUsers()
    {
        $token = Yii::$app->params['token'];
        $headers = Yii::$app->request->headers;

        if($token != @$headers['token']) return $this->asJson(false);

        $clients = Clients::find()->with('bonuses')->all();

        foreach ($clients as $key => $client) {
            $clients[$key]->bonus = $client->bonuses->name;
        }

        return $this->asJson($clients);
    }
}
