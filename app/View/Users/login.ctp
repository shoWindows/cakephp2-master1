<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('名前とパスワードを入力してください'); ?></legend>
        <?php
            echo $this->Form->input('user_name');
            echo $this->Form->input('password');
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>