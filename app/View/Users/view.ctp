<h2><?php echo h($user['User']['user_name']); ?></h2>

<p><?php echo h($user['User']['user_furigana']); ?></p>

<p><?php echo h($user['User']['address']); ?></p>

<p><?php echo h($user['User']['phone_number']); ?></p>

<p><?= h($viewUserHobbyLabel); ?></p>

<p><?= h($userHomeLabel); ?></p>

<p><?= h($userAge."歳"); ?></p>

<?php echo $this->Html->link('編集', array('action'=>'edit', $user['User']['id'])); ?>

<?php echo $this->Form->postLink('削除', array('action'=>'delete', $user['User']['id']),array('confirm'=>'本当に削除しますか?'));