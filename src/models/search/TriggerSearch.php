<?php


namespace webrise1\trigger\models\search;

use DateTime;
use webrise1\pdfgenerator\models\Certificate;
use webrise1\trigger\models\Trigger;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use Yii;

/**
 * Class CertificateSearch
 * @package app\models\search
 */
class TriggerSearch extends Trigger
{


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'status'], 'integer'],
            [[ 'name','title','function_name'], 'string'],

        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($triggerClass)
    {
        $this->load(Yii::$app->request->queryParams);

        $query = $triggerClass::find();
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['function_name'=> $this->function_name]);
        $query->andFilterWhere(['status'=> $this->status]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
}