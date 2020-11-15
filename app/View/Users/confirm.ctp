<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>


<html>
  <head>
    <h1>この内容でよろしいですか？<h1>
  </head>
  <body>
    <?php

    echo $this->Html->script('user/confirm');
    echo $this->Html->css('confirm');

    debug($this->request->data);

    $formdata = $this->request->data["User"]; 
    ?>


    <?php echo $this->Form->create('User' ,['url' => ['action' => 'send'],'class' => 'form']); ?>
    <span>名前：</span>
    <?= $formdata["user_name"]?>
    <br />
    <span>フリガナ：</span>
    <?= $formdata["user_furigana"]?>
    <br />

    <span>住所：</span>
    <?= $formdata["address"]?>
    　　<?php //echo $this->Form->value('address'); ?>　<br>

    <span>電話番号：</span>
    <?= $formdata["phone_number"]?>
    　　<?php //echo $this->Form->value('phone_number'); ?>　<br>

    <span>趣味：</span>
    <?= $hobbyLabel?>
    　　<?php //echo $this->Form->value('hobby_name'); ?>　<br>

    <span>出身地：</span>
    <?= $userChoicePrefecture ?>
        <?php //echo $this->Form->value('hobby_name'); ?>　<br>

    <span>年齢：</span>
    <?= $userAge."歳"?>
        <?php //echo $this->Form->value('hobby_name'); ?>　<br>


    <?php echo $this->Form->end('登録する'); ?>

    <button> <?php echo $this->Html->link('戻る', array('controller'=>'Users','action'=>'add')); ?> </button>
  </body>
</html>
