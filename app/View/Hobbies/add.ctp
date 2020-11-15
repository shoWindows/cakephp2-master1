<h2>趣味追加 画面</h2>
<?php
echo $this->Form->create('Hobby', ['url' => ['action' => 'confirm']]);

echo $this->Form->input('hobby_name',array(
  'type' => 'text',
  'label' => '趣味名を入力してください',
  'required'=>true,
));

echo $this->Form->end('登録');

?>

<br>

<?= $this->Form->button('趣味一覧に戻る', ['onclick' => 'history.back()', 'type' => 'button']) ?>

