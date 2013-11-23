<?php
/* @var $this UsersController */

$lang = new Language;

$this->breadcrumbs=array(
    $lang->Translate(19)=>'/friends',
    $lang->Translate(25),
);
?>
<h1><?php echo $lang->Translate(25)?></h1>

<p>


    <?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
    ?>


</p>
