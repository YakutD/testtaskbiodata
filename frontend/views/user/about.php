<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\VarDumper;

$this->title = 'Профиль пользователя';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<br>
<div class="site-about">
    <div class="media">
        <div class="media-left">
            <img class="media-object" src="<?="{$user['picture']['data']['url']}"?>">
        </div>
        <div class="media-body">
            <h4 class="media-heading ">
                <?="{$user['first_name']} {$user['last_name']}"?>
                <br>
                <small><?="{$user['email']}"?></small>
            </h4>
            <?if(!is_null($user['bonus'])):?>
                <p>Ваш бонус: <?=$user['bonus']?></p>
            <?endif;?>
        </div>
        <?if(is_null($user['bonus'])):?>
        <br>
        <div class="btn-group">
            <a href="/bonus" type="button" class="btn btn-success">
                Получить бонус 
            </a>
        </div>
        <?endif;?>
    </div>
</div>
