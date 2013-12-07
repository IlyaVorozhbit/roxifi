<h1>Admin Panel</h1>

<div class="form">
    <p><a href="/man/users">На данный момент в системе пользователей: <?php echo $users_count;?></a></p>
    <p>Дружественных связей между ними: <?php echo $friends_count;?></p><hr>
    <p>Сообщений в диалогах: <?php echo $messages_count;?></p>
    <p>Материалов в базе: <?php echo $materials_count;?></p>
    <p>Записей в блогах: <?php echo $blog_records;?></p>
</div>