<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Список пользователей';
?>
<h1><?= Html::encode($this->title) ?></h1>
<br>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Дата регистрации</th>
                        <th>Бонус</th>
                    </tr>
                </thead>
                <tbody>
                    <?for($i = 0; $i < count($clients);$i++):?>
                        <tr>
                            <td><?=$i+1?></td>
                            <td><?=$clients[$i]->created_at?></td>
                            <td><?=$clients[$i]->bonus ?? 'Нет бонуса'?></td>
                        </tr>
                    <?endfor;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
