<?php
    /*
    * @var $this DialogsController
    * @var $lang Language
    */

    $this->pageTitle .= Yii::t('events','Invites');


?>

<h1><?php echo Yii::t('events','Invites');?></h1>

<div class="events">
    <div class="invites">
        <?php
            if(!empty($invites['invites']))
               foreach($invites['invites'] as $invite)
                   $this->renderPartial('_invite',array('invite'=>$invite));
        ?>
    </div>
</div>