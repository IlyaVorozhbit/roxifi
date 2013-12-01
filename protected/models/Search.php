<?php
  class Search extends CActiveRecord
  {
    public $criteria;

    public static function searchByString($string)
    {
      $command = new CDbCriteria;
      $command->alias = 'users';
      $command->join = 'LEFT JOIN users_info ON users.id = users_info.user';
      $command->condition = 'users.name LIKE "%'.$string.'%" OR users.surname LIKE "%'.$string.'%"';
      $command->distinct = true;
      $pages = new CPagination(Users::model()->count($command));
      $pages->pageSize = 10;
      $pages->applyLimit($command);
      $ret['pages'] = $pages;
      $ret['users'] = Users::model()->findAll($command);
      return $ret;
    }

    public static function model($className=__CLASS__)
    {
      return parent::model($className);
    }
  }
?>
