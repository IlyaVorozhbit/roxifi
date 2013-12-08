<?php

class ManModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'man.models.*',
			'man.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{

            if(!Admins::model()->exists('admin=:admin',array(':admin'=>Yii::app()->user->id)))
                Yii::app()->getController()->redirect('/');

            if((empty(Yii::app()->session['admin'])))
            {

                if(isset($_POST['password']))
                {
                    //4RE3QW.r
                    $admin = Admins::model()->find('admin=:admin and password=:pass',array(
                        ':admin'=>Yii::app()->user->id,
                        ':pass'=>md5($_POST['password'].'.r')
                    ));

                    if(is_null($admin))
                        Yii::app()->getController()->redirect('/');

                    Yii::app()->session['admin'] = $admin->admin;

                    Yii::app()->getController()->redirect('/man');
                }

                Yii::app()->getController()->render('login');
                Yii::app()->end();

            }
			return true;
		}
		else
			return false;
	}
}
