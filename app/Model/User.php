<?php

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
  public $name = 'User';
  
  // 論理削除用ビヘイビア
  public $actsAs = array( 'SoftDelete' );


  public $validate = array(
        'user_name' => array(
             'rule' => 'notBlank',
             'message' => 'ユーザ名は必須です。'
        ),
        'user_furigana' => array(
             'rule' => 'notBlank',
             'message' => 'フリガナは必須です。'
            
        ),
        'address' => array(
             'rule' => 'notBlank',
             'message' => '住所は必須です。'
        ),
        'phone_number' => array(
             'rule' => 'notBlank',
             'message' => '電話番号は必須です。'
        ),
        'hometown' => array(
          'rule' => 'notBlank',
          'message' => '地域と都道府県が入力されてません。'
        ),
        // 'hobbies' => array(
        //   'rule' => 'notBlank',
        //   'message' => '趣味情報が入力されてません'
        // ),
        'birthday' => array(
          'rule' => 'notBlank',
          'message' => '生年月日が入力されてません'
        ),
  );
}