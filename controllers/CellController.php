<?php

namespace app\controllers;

use app\models\Cell;
use app\models\Map;
use app\models\Answer;
use app\models\Contact;
use app\models\CellSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use app\models\User;
use app\models\Logbook;
use yii\helpers\Url;

/**
 * CellController implements the CRUD actions for Cell model.
 */
class CellController extends Controller
{
    private function isAdmin(): bool {
        if(Yii::$app->user->isGuest) {
            return false;
        }
        $user = Yii::$app->user->identity->user;
        /* @var $user User*/
        return $user->type == User::TYPE_ADMIN;
    }
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function()
                            {
                                return $this->isAdmin();
                            }
                        ],
                        [
                            'actions' => ['index', 'view'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Cell models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CellSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }    

    public function actionView($id, $contactId = null) {
        $model = $this->findModel($id);
        \Yii::$app->user->identity->product = $model->answer1->map->product;

        $cellCodes = Cell::getCodeList($model->answer1->map_id);
        $cellIds = array_flip($cellCodes);

        $dateCounts = Logbook::getCountsByCellIds($cellIds);
        $counts = [];
        foreach($dateCounts as $cellId => $data) {
            $counts[$cellCodes[$cellId]] = max($data);
        }                

        return $this->render('view', [
            'model' => $model,            
            'cellCodes' => $cellCodes,
            'counts' => $counts,
        ]);
    }

    public function actionContent($id) {
        $model = $this->findModel($id);
        $cellCodes = Cell::getCodeList($model->answer1->map_id);
        $cells = Cell::findAllByMapId($model->answer1->map_id);

        return $this->render('content', [
            'model' => $model,
            'code' => $cellCodes[$model->id],
        ]);
    }

    /**
     * Creates a new Cell model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($mapId)
    {
        $model = new Cell();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['/map/view', 'id' => $model->answer1->map_id, 'tab' => 'cells']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('form', [
            'model' => $model,
            'map' => Map::findOne($mapId),
            'answers1' => Answer::getAnswerList($mapId, 1),
            'answers2' => Answer::getAnswerList($mapId, 2),
        ]);
    }

    /**
     * Updates an existing Cell model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $codes = Cell::getCodeList($model->answer1->map_id);
        if(!$model->color) {
            $colors = Cell::defaultColors();
            $model->color = $colors[$codes[$model->id]];
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['/map/view', 'id' => $model->answer1->map_id, 'tab' => 'cells']);
        }

        return $this->render('form', [
            'model' => $model,
            'map' => $model->answer1->map,
            'answers1' => Answer::getAnswerList($model->answer1->map_id, 1),
            'answers2' => Answer::getAnswerList($model->answer1->map_id, 2),
            'code' => $codes[$model->id]
        ]);
    }

    /**
     * Deletes an existing Cell model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['/map/view', 'id' => $model->answer1->map_id, 'tab' => 'cells']);
    }

    /**
     * Finds the Cell model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cell the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cell::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
