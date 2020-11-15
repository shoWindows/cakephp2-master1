<h2>趣味　編集画面</h2>


<?php
echo h("変更前");
?>
&nbsp;
<?php
echo h($hobby['Hobby']['hobby_name']);
?>

<br>
<br>

<?php
echo $this->Form->create('Hobby');

echo $this->Form->input("hobby_name",array(
  'type' => 'text',
  'label' => '新しい趣味名を入力してください。',
  'required'=>true,
));

echo $this->Form->end('変更');

?>

<?= $this->Form->button('趣味一覧に戻る', ['onclick' => 'history.back()', 'type' => 'button']) ?>