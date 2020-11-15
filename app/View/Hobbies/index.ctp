<h2>趣味一覧</h2>

<table>
    <tr>
        <th>
            名前
        </th>
        <th>
            操作
        </th>
    </tr>

    <?php foreach ($hobbies as $hobby) : ?>
        <tr>
            <td>
                <?php echo h($hobby['Hobby']['hobby_name']); ?>
            </td>
            <td>
                <button> <?php echo $this->Html->link("変更", '/hobbies/edit/'.$hobby['Hobby']['id']); ?> </button>
                <button> <?php echo $this->Form->postLink('削除', array('action'=>'delete',$hobby['Hobby']['id']),array('confirm'=>'本当に削除しますか?')); ?> </button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<button> <?php echo $this->Html->link('趣味を新たに追加する', array('controller'=>'Hobbies','action'=>'add')); ?> </button>

<br>
<br>

<button> <?php echo $this->Html->link('ユーザー一覧に戻る', array('controller'=>'Users','action'=>'index')); ?> </button>
