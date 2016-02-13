<?php

namespace app\controllers;

use Yii;
use app\models\Books;
use app\search\BooksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [[
                    'allow' => true,
                    'roles' => ['@']
                ]],
            ]
        ];
    }

    /**
     * Lists all Books models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BooksSearch();
        if(!Yii::$app->request->queryParams && isset(Yii::$app->session['books_params']) && isset(Yii::$app->session['books_edit'])) {
            Yii::$app->request->queryParams = Yii::$app->session['books_params'];
        } else if (Yii::$app->request->queryParams) {
            Yii::$app->session['books_params'] = Yii::$app->request->queryParams;
        }

        unset(Yii::$app->session['books_edit']);

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Books model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }
    /* Save file for model in preview */
    public function saveFile($model) {
        if ($file = UploadedFile::getInstance($model, 'preview')) {
            if ($file->name) {
                $base = Yii::getAlias('@app/web/upload');
                $key = md5(microtime() . $file->name);
                $file->saveAs($base . "/{$key}_{$file->name}", false);
                $model->preview = "upload/{$key}_{$file->name}";
                $model->save();
            }
        }
    }

    public function actionRemoveImage($id) {
        $model = $this->findModel($id);
        unlink(Yii::getAlias("@app/web/{$model->preview}"));
        $model->preview = "";
        $model->save();
        return $this->redirect(['update', 'id' => $model->id]);
    }

    /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Books();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->saveFile($model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_file = $model->preview;
        Yii::$app->session['books_edit'] = true;

        if ($model->load(Yii::$app->request->post())) {
            if (!$model->preview) {
                $model->preview = $old_file;
            }
            if ($model->save()) {
                $this->saveFile($model);
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Books::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
