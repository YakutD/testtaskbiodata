<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use app\models\Clients;
use app\models\Bonuses;
use yii\helpers\VarDumper;


/**
 * User controller
 */
class UserController extends Controller
{

    private $fb_id;
    
    public function beforeAction($action)
    {
        if(empty( $_SESSION['fb_user'])){
            return $this->redirect(['/'])->send();
        }else{
            $this->fb_id = $_SESSION['fb_user']['id'];
        }
        return parent::beforeAction($action);
    }

    public function actionProfile()
    {
        $client = Clients::find()->with('bonuses')->where(['fb_id' => $this->fb_id])->one();
        if(empty($client)){
            $client = new Clients();
            $client->fb_id = $this->fb_id;
            $client->created_at = date('Y-m-d');
            $client->bonus = null;
            $client->save();
        }
        $_SESSION['fb_user']['bonus'] = $client->bonuses->name;

        return $this->render('about', ['user' =>  $_SESSION['fb_user']]);
    }

    public function actionBonus(){

        $client = Clients::find()->where(['fb_id' => $this->fb_id])->one();
        if(!is_null($client->bonus)) return $this->redirect(['/profile']);

        $bonuses_sample = Bonuses::find()->where(['or', ['>', 'amount', 0], ['amount' => null]])->all();
        $rand_key = array_rand($bonuses_sample);
        $bonus = $bonuses_sample[$rand_key];

        $client->bonus = $bonus->id;
        $client->save();

        $bonus->amount = (!is_null($bonus->amount)) ? --$bonus->amount : null;
        $bonus->save();

        return $this->redirect(['/profile']);
    }
}
