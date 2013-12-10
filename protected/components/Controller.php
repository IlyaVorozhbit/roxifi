<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

    public $pageTitle;

    public $lang;

	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public function beforeAction($action)
    {

       $this->lang = new Language();

        return parent::beforeAction($action);

    }

    public function init()
    {

        $this->pageTitle = Yii::app()->name.' - ';

        try
        {
            if (Yii::app()->user->id !== NULL)
                Yii::app()->language = Users::model()->findbyPk(Yii::app()->user->id)->language;
            else
                Yii::app()->language= 'ru';
        }
        catch(Exception $e)
        {
            Yii::app()->language = 'ru';
        }

        if(!Yii::app()->user->isGuest)
        {

            if(Yii::app()->user->id==2)
                echo time()-strtotime(Yii::app()->session['last_update']);

            if((empty(Yii::app()->session['last_update'])) or (time()-strtotime(Yii::app()->session['last_update'])>60*10))
            {
                Yii::app()->session['last_update'] = date('Y-m-d H:i:s',time());
                $user = Users::model()->findByPk(Yii::app()->user->id);
                $user->last_update = Yii::app()->session['last_update'];
                $user->save();
            }

        }

        parent::init();
    }

}