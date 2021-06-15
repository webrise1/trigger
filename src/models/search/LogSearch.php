<?php


namespace webrise1\trigger\models\search;

use webrise1\trigger\models\Log;
use yii\data\ActiveDataProvider;
use Yii;

/**
 * Class CertificateSearch
 * @package app\models\search
 */
class LogSearch extends Log
{


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'status'], 'integer'],
            [[ 'trigger_code','message'], 'string'],

        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($trigger_id)
    {
        $this->load(Yii::$app->request->queryParams);
        $query = Log::find();
        $query->andFilterWhere(['status'=> $this->status]);
        $query->andFilterWhere(['like','trigger_code', $this->trigger_code]);
        $query->andFilterWhere(['trigger_id'=>$trigger_id]);
        $query->andFilterWhere(['like','message', $this->message]);
        $query->orderBy('created_at DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
}