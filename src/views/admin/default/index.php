<?php
use yii\helpers\Html;
use yii\grid\GridView;
use webrise1\trigger\models\Trigger;
use Yii;

?>

<div class="trigger-index">
    <?=Html::a('Создать триггер',['create'],['class'=>'btn btn-success'])?>

<?=Html::a('Системные логи',['/admin/trigger/log/index','trigger_id'=>0],['class'=>'btn btn-success'])?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
//        ['class' => 'yii\grid\SerialColumn'],
         'id',
        'name',
        'title',
        [
            'attribute'=>  'status',
            'filter'=>Trigger::getStatuses(),
            'value'=>function($model){
                return $model->getStatuses()[$model["status"]];

            }
        ],
        [
            'filter'=>(new Yii::$app->controller->module->triggerModel())->getArrayMapFunctions(),
            'attribute'=>  'function_name',
            'format'=>'raw',
            'value'=>function($model){
                return $model->getTitleTriggerFunctionByName($model["function_name"]);

            }
        ],
        [
           'format'=>'raw',
           'value'=>function($model){
                return Html::a('Логи',['admin/log/index','trigger_id'=>$model->id],['class'=>'btn btn-success']);
           }
        ],


        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} ',
        ],
    ],
]); ?>
</div>
