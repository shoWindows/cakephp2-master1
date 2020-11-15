<?php

class Hobby extends AppModel {

    public $actsAs = array( 'SoftDelete' );


    public $validate = array(
        'hobby_name' => array(
            'rule' => 'notBlank',
            'message' => 'ユーザ名は必須です。'
        ),
    );
}