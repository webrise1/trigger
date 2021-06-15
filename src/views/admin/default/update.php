<?php

/* @var $this yii\web\View */
/* @var $model app\models\Certificates */

//$this->title = 'Триггер: ' . $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Шаблоны сертификатов', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $model->id;
?>

<div class="trigger-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>