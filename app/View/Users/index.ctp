<button> <?php echo $this->Html->link('ユーザーを登録する', array('controller'=>'users','action'=>'add'));?> </button> <br>
<br>
<button> <?php echo $this->Html->link('趣味一覧を確認する(趣味を追加、編集可能)', array('controller'=>'Hobbies','action'=>'index'));?> </button> <br>
<br>
<br>
<head>
    <?php echo $this->Html->charset(); ?>
    <h2>ユーザー一覧</h2>
</head>
<table>
    <tr>
        <th>
            操作
        </th>
        <th>
            名前
        </th>
        <th>
            フリガナ
        </th>
        <th>
            出身地
        </th>
        <th>
            email
        </th>
        <th>
            電話番号
        </th>
        <th>
            趣味
        </th>
        <th>
            年齢
        </th>
    </tr>

    <?php $showFields = [
        'user_name', 'user_furigana', 'hometown',
        'email','phone_number',"user_hobbies","birthday"
        ]
    ?>
    <?php foreach ($users as $user) : ?> 
        <tr>
                <td>
                <button>
                    <?php
                        echo $this->Html->link(
                            '編集',
                            array('action'=>'edit', $user['id'])
                        );?>
                </button>
                <button>
                    <?php echo $this->Form->postLink('削除', array('action'=>'delete', $user['id']),array('confirm'=>'本当に削除しますか?'));?>
                </button> 
                </td>
            <?php foreach ($showFields as $field) : ?>
                <td>
                    <p><?php echo ($user[$field]); ?></p>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>