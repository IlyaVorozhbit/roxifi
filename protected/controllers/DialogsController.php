<?php

class DialogsController extends Controller
{

    public $defaultAction = 'DialogList';

	public function actionBan()
	{
		$this->render('Ban');
	}

	public function actionDelete()
	{
		$this->render('Delete');
	}

	public function actionDialog()
	{
		$this->render('Dialog');
	}

	public function actionDialogList()
	{
		$this->render('DialogList');
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