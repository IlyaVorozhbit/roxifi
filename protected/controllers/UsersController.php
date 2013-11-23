<?php

class UsersController extends Controller
{

    public $defaultAction = 'Profile';

	public function actionFriends()
	{
		$this->render('Friends');
	}

	public function actionProfile($id)
	{
		$this->render('Profile',array('user'=>Users::model()->with('wallRecords', 'usersInfos')->findByPk($id)));
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
