<html>
  <head>
    <h1>この内容でよろしいですか？<h1>
  </head>
  <body>
    <?php

    echo $this->Html->css('confirm');

    //debug($this->request->data);
    
    $formdata = $this->request->data["Hobby"]; //セッションのデータを$formdataに代入
    ?>


    <?php echo $this->Form->create('Hobby' ,['url' => ['action' => 'send'],'class' => 'form']); ?>
    <span>趣味の名前</span>
     <?= $formdata["hobby_name"]?>
    　　<?php //echo $this->Form->value('user_name'); ?>　<br>
   
    <?php echo $this->Form->end('登録する'); ?>
    <?= $this->Form->button('戻る', ['onclick' => 'history.back()', 'type' => 'button']) ?>
  </body>
</html>

