<?php

class GroupsController extends Controller
{

    public $defaultAction = 'List';


    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('create','delete','edit','group','list','permissions'),
                'users'=>array('@'),
            ),

            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

	public function actionCreate()
	{
		$this->render('Create');
	}

	public function actionDelete()
	{
		$this->render('Delete');
	}

	public function actionEdit()
	{
		$this->render('Edit');
	}

	public function actionGroup()
	{
		$this->render('Group');
	}

	public function actionList()
	{
		$this->render('List');
	}

	public function actionPermissions()
	{
		$this->render('Permissions');
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