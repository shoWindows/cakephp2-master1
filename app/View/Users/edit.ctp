<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>

<script>
  var prefecture = <?php echo json_encode($prefecture);?>;
  var prefectureArr = <?php echo json_encode($prefectureArr);?>;
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

<h2>編集画面</h2>

<?php
echo $this->Html->script(array(
  'user/edit',
  'user/jquery.autoKana',
));
echo $this->Form->create('User', ['url' => ['action' => 'confirm']], array('users/edit/'));
echo $this->Form->input('user_name',array(
  'type' => "text",
  'name' => "user_name",
  'id' => "firstLastName",
  'label' => 'ユーザー',
  "placeholder" => "ユーザー名を入力してください" ,
  'pattern' => ".{2,50}"
));

echo $this->Form->input('user_furigana',array(
  'type' => "text",
  'name' => "user_furigana",
  'id' => "firstLastName-furigana",
  'label' => 'フリガナ' ,
  "placeholder" => "フリガナを入力してください",
  'pattern' => ".{2,100}",
  'required'=>true
));

echo $this->Form->input('address', array('rows'=>3,"placeholder" => "住所を入力してください", 'label' => '住所','required'=>true));
echo $this->Form->input('phone_number',array('label' => '電話番号',"placeholder" => "電話番号を入力してください", 'pattern' => "\d{2,4}-?\d{2,4}-?\d{3,4}",'required'=>true));

echo $this->Form->input('area',array(
    'type' => 'select',
    'multiple'=> false,
    'options' => $areas,
    'default' => $userAreNum,
    'id' => 'area',
    'label' => '地域',
    'required'=>true,
));


echo $this->Form->input('prefecture',array(
    'type' => 'select',
    'multiple'=> false,
    'empty' => "地方を選択してください",
    'default' => $hobbyNum,
    'options' => $prefecture,
    'id' => 'prefecture',
    'label' => '都道府県',
    'required'=>true
));

echo $this->Form->input( 'hobby_name', array(
    'label' => '趣味',
    'type' => 'select',
    'multiple'=> 'checkbox',
    'default' => $editUserhobbyArr,
    'options' => $select1,
    'required'=>true
));

echo $this->Form->input( 'birthday',array(
    'type' => 'text',
    'id' => 'datepicker',
    'autocomplete' => 'off',
    // 'readonly' =>true,
    'label' => '誕生日',
    // 'required'=>true
  ));


echo $this->Form->end('確認画面へ'
);

?>