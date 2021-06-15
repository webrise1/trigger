<?php
use yii\helpers\Html;
use yii\grid\GridView;
use webrise1\trigger\models\Trigger;
use webrise1\trigger\models\Log;
use Yii;

?>

<div class="log-index">

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'rowOptions'=>function($model){
        switch ($model['status']){
            case Log::STATUS_SUCCESS:
                return ['class' => 'success-log'];
            break;
            case Log::STATUS_ERROR:
                return ['class' => 'error-log'];
                break;
        }
        return null;
    },
    'columns' => [
//        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'trigger_code',
        'message',
        [
            'attribute'=>  'status',
            'filter'=>Log::getStatuses(),
            'value'=>function($model){
                return $model->getStatuses()[$model["status"]];

            }
        ],
        'created_at'
         ,


//        [
//            'class' => 'yii\grid\ActionColumn',
//            'template' => '{update} ',
//        ],
    ],
]); ?>