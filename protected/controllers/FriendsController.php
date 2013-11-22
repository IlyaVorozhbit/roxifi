<?php

class FriendsController extends Controller
{

    public $defaultAction = 'FriendList';

	public function actionAccept()
	{
		$this->render('Accept');
	}

	public function actionAdd()
	{
		$this->render('Add');
	}

	public function actionDelete()
	{
		$this->render('Delete');
	}

	public function actionFriendList()
	{
		$this->render('FriendList');
	}

	public function actionReject()
	{
		$this->render('Reject');
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