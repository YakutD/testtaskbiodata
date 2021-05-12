<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\base\ErrorException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * Fb controller
 */
class FbController extends Controller
{
    public function actionAuth()
    {
        if (!empty($_GET['code'])) {
 
            $params = array(
                'client_id'     => Yii::$app->params['fb']['client_id'],
                'client_secret' => Yii::$app->params['fb']['client_secret'],
                'redirect_uri'  => Yii::$app->params['fb']['redirect_uri'],
                'code'          => $_GET['code']
            );
            
            // Получение access_token
            try {
                $data = file_get_contents(Yii::$app->params['fb']['graph_url'] . '/oauth/access_token?' . urldecode(http_build_query($params)));
                $data = json_decode($data, true);
            }catch(ErrorException $e){
                throw new BadRequestHttpException($e->getMessage());	
            }

            if (!empty($data['access_token'])) {
                $params = array(
                    'access_token' => $data['access_token'],
                    'fields'       => 'id,email,first_name,last_name,picture'
                );
         
                // Получение данных пользователя
                try {
                    $info = file_get_contents(Yii::$app->params['fb']['graph_url'] . '/me?' . urldecode(http_build_query($params)));
                    $info = json_decode($info, true);
                }catch(ErrorException $e){
                    throw new BadRequestHttpException($e->getMessage());	
                }

                $_SESSION['fb_user'] = $info;
                return $this->redirect(['/profile']);
            }else throw new BadRequestHttpException('Ошибка авторизации через Facebook');		
        }else return $this->redirect(['/']);
    }
}
