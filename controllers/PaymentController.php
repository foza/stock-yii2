<?php

namespace app\controllers;

use Yii;
use app\models\Payment;
use app\models\PaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentController implements the CRUD actions for Payment model.
 */
class PaymentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Payment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = \app\models\Client::find()->where(['status'=>1])->all();

        return $this->render('index', ['model' => $model, ]);
    }

    public function actionView($id){
        $model = \app\models\Customer::find()->where(['client_id'=>$id])->all();
        $client = \app\models\Client::findOne($id)->title;
        return $this->render('view',['model'=>$model, 'client'=>$client]);
    }
    public function actionClientView($client_id, $cutomer_id){
        $model = Payment::find()->where(['client_id' => $client_id, 'cutomer_id' => $cutomer_id])->all();
        $client = \app\models\Client::findOne($client_id)->title;
        return $this->render('client-view', ['model' => $model,'client'=>$client,'client_id'=>$client_id]);
    }

    public function actionClientCreate($client_id, $cutomer_id)
    {
        $model = new Payment();
        if ($model->load(Yii::$app->request->post())) {
            $model->client_id = $client_id;
            $model->cutomer_id = $cutomer_id;
            if ($model->save()) {
                return $this->redirect(['client-view', 'client_id' => $client_id, 'cutomer_id' => $cutomer_id]);
            } else {
                print_r($model->errors);
            }
        } else {
            return $this->render('client-create', ['model' => $model,'client_id'=>$client_id]);
        }
    }

    /**
     * Updates an existing Payment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Payment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Payment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Payment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Payment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
