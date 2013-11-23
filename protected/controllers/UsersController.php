<?php

include_once('d_console.php');

class UsersController extends Controller
{
  public $defaultAction = 'Profile';

	public function actionFriends()
	{
		$this->render('Friends');
	}

	public function actionNotes($id)
	{
    $model = new Notes();

    if (isset($_POST['Notes']))
    {
      $model->attributes = $_POST['Notes'];
      $model->creator = Yii::app()->user->id;
      $model->time = date('Y-m-d H:i:s',time());
      $model->save() or die(print_r($model->getErrors()));
    }

    $criteria=new CDbCriteria;
    $criteria->condition = 'creator =:user';
    $criteria->order = 'time desc';
    $criteria->params = array(':user'=>$id);
    $pages=new CPagination(Notes::model()->count($criteria));
    $pages->pageSize=1;
    $pages->applyLimit($criteria);

    $notes = Notes::model()->findAll($criteria);
		$this->render('Notes', array(
            'user'=>Users::model()->with('usersInfos')->findByPk($id),
            'notes'=>$notes,
            'pages'=>$pages,));
	}

	public function actionProfile($id)
	{
    $model = new WallRecords();

    if (isset($_POST['WallRecords']))
    {
      $model->attributes = $_POST['WallRecords'];
      $model->user_from = Yii::app()->user->id;
      $model->user_to = $id;
      $model->time = date('Y-m-d H:i:s',time());
      $model->status = 1;
      $model->save() or die(print_r($model->getErrors()));
    }

    $criteria=new CDbCriteria;
    $criteria->condition = 'user_to =:user and status = 1';
    $criteria->order = 'time desc';
    $criteria->params = array(':user'=>$id);
    $pages=new CPagination(WallRecords::model()->count($criteria));
    $pages->pageSize=1;
    $pages->applyLimit($criteria);

    $wallRecords = WallRecords::model()->findAll($criteria);

		$this->render('Profile',array(
            'user'=>Users::model()->with('usersInfos')->findByPk($id),
            'wallRecords'=>$wallRecords,
            'pages'=>$pages,
            'model'=>$model
        ));
	}

	public function actionSearch()
	{
		$this->render('Search');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
