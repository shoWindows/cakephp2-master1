<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>



<script>
  var prefecture = <?php echo json_encode($prefecture);?>;
  var thisURL = <?php echo json_encode($thisURL);?>;
</script>

<script>
  $(function() {
      $("#datepicker").datepicker({
        yearRange: "1900:2020",
        changeYear: true, changeMonth: true,
        maxDate: new Date, minDate: new Date(1900, 1, 1)
      });
  });
</script>

<h2>ユーザー新規登録画面</h2>

<?php
echo $this->Html->script(array(
  'user/add',
  'user/jquery.autoKana',
));
echo $this->Form->create('User', ['url' => ['action' => 'confirm']], array('users/add/'));
echo $this->Form->hidden('isSelectArea',["id" => "isSelectArea"]);
echo $this->Form->input('user_name',array(
  'type' => "text",
  'id' => "firstLastName",
  'label' => 'ユーザー',
  "placeholder" => "ユーザー名を入力してください" ,
  'pattern' => ".{2,50}"
));

echo $this->Form->input('user_furigana',array(
  'type' => "text",
  'id' => "firstLastName-furigana",
  'label' => 'フリガナ' ,
  "placeholder" => "フリガナを入力してください",
  'pattern' => ".{2,100}",
  'required' => true
));

echo $this->Form->input('address', array('rows'=>3,"placeholder" => "住所を入力してください", 'label' => '住所','required'=>true));
echo $this->Form->input('phone_number',array('label' => '電話番号',"placeholder" => "電話番号を入力してください", 'pattern' => "\d{2,4}-?\d{2,4}-?\d{3,4}",'required'=>true));

echo $this->Form->input('area',array(
  'type' => 'select',
  'multiple'=> false,
  'options' => $areas,
  'empty' => "選択してください",
  'default' => $pref_id,
  'id' => 'area',
  'label' => '地域',
  'required' => true
));

echo $this->Form->input('prefecture',array(
  'type' => 'select',
  'multiple'=> false,
  'options' => $thisPref,
  'empty' => '地域を選択してください',
  'class' => "prefClass",
  'id' => 'hokkaidoSel',
  'label' => '都道府県',
));

echo $this->Form->input( 'hobby_name', array(
  'type' => 'select',
  'multiple'=> 'checkbox',
  'options' => $hobby,
  'label' => '趣味を選択してください',
  'required'=>true
));

echo $this->Form->input( 'birthday',array(
  'type' => 'text',
  'id' => 'datepicker',
  'autocomplete' => 'off',
  // 'readonly' =>true,
  "placeholder" => "生年月日を入力してください",
  'label' => '生年月日',
  // 'required'=>true
));

echo $this->Form->end('確認画面へ');

?>