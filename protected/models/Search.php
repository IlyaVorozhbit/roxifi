<?php
  class Search extends CActiveRecord
  {
    public $criteria;

    public static function searchByString($string)
    {
      $ex_string = explode(' ', $string);
      $command = new CDbCriteria;
      $command->alias = 'users';
      $command->join = 'LEFT JOIN users_info ON users.id = users_info.user';
      $command->condition = 'users.name LIKE "%'.$string.'%" OR users.surname LIKE "%'.$string.'%" OR
                             users.login LIKE "%'.$string.'%"'.(count($ex_string) > 1 ?
                               'OR (users.name LIKE "%'.$ex_string[0].'%" AND users.surname LIKE "%'.$ex_string[1].'%") OR
                                (users.name LIKE "%'.$ex_string[1].'%" AND users.surname LIKE "%'.$ex_string[0].'%")' : '');
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
