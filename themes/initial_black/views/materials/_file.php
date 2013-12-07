<div class="file">
    <div class="name">
      <?php echo $file->name;?>
    </div>
    <div class="del_btn">
        <a href="/materials/DeleteFile/<?php echo $file->id?>" class="btn del_btn"><?php echo Yii::t('materials','Delete');?></a>
    </div>
    <div class="extension">
        <a href="/files/u<?php echo $file->user;?>/<?php echo $file->file;?>"><?php echo strstr($file->name,'.');?></a>
    </div>

</div>
