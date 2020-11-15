<?php

class UsersController extends AppController {
  public $helpers = array('Html', 'Form');
  public $uses = ['User','Hobby'];   //UsersコントローラーでHobbyモデルが使えるように宣言する
  public $components = array('Session');  //セッションを使えるようにする

  // public function beforeFilter() {
  //   parent::beforeFilter();
  //   $this->Auth->allow('login', 'add');
  // }

  public function login() {
    if ($this->request->is('post')) {
        if ($this->Auth->login()) {
            $this->redirect($this->Auth->redirect());
        } else {
            $this->Session->setFlash(__('名前、パスワードを登録してください。'));
        }
    }
  }

  public function index() {
    $viewUserHobbies = $this->User->find( 'list', [
      'fields' => ['id', 'user_hobbies']
    ]);
    $hobbyList = $this->Hobby->find( 'list', [
      'fields' => ['id', 'hobby_name']
    ]);
    $users = $this->User->find('all', [
      'deleted' => null,
    ]);
    foreach ($users as $user){
      $formedUsers[$user['User']['id']] = $user['User']; //cakephpの癖である配列の中の配列を1個繰り上げて戻す
    }

    foreach ($viewUserHobbies as $userID => $userHobby){ // as キー変数名 => 値変数名　でそれぞれ別々に取り出せる
      $hobbyStr = '';
      $userHobbyArr = explode("-", $userHobby); //値の部分だけexplodeしている
      foreach ($userHobbyArr as $userHobbyID){ //その値をforeachで回す。
        if (array_key_exists($userHobbyID, $hobbyList)){ //値が削除されている場合に備えてif文で$hobbyListの添字に存在するかチェック
          $hobbyStr .= $hobbyList[$userHobbyID] . '<br />'; //もし存在すれば、文字列に返して$hobbyStrに代入
        }
      }
      $formedUsers[$userID]['user_hobbies'] = $hobbyStr; //趣味名をそのまま$formedUsers[$userID]['user_hobbies']に代入
    }

    $this->convertData($formedUsers);  //convertData関数を引数を渡して呼び出し

  }

  private function convertData($formedUsers){
    $areas = Configure::read("area");
    $prefecture = Configure::read("Prefecture");
    foreach ($formedUsers as $n => $formedUser ){
      $areaLabel = $prefLabel = "";
      $userHomeArr = explode("-", $formedUsers[$n]["hometown"]);
      $user_area = $userHomeArr[0];
      $user_pref = $userHomeArr[1];
      $areaLabel .= $areas[$user_area];
      $prefArr = $prefecture[$user_area];
      $prefLabel .= $prefArr[$user_pref];
      $formedUsers[$n]["hometown"] = $areaLabel . '/' .$prefLabel;
    }

    foreach ($formedUsers as $n => $formedUser ){
      $userBirthDate = ($formedUser["birthday"]);
      $now = date("Ymd");
      $birthday = str_replace("-", "", $userBirthDate);
      $userAge = floor(($now-$birthday)/10000);
      $formedUsers[$n]["birthday"] = $userAge. '歳';
    }

    $this->set('users', $formedUsers ,$userAge);

  }

  public function add($pref_id = null) {
    // $thisURL = Router::url('/users/add/', true);
    if ($this->request->is("get")){ //もしgetで送られてきたら、地域エリアを変更時に発動
      if ($this->Session->check("User")){ //もしSessionが存在すれば
        $thisSession = $this->Session->read("User");
        debug($thisSession);
        if (array_key_exists("isSelectArea", $thisSession["User"])){ //もしisSelectAreaキーがあれば
          $thisData = $this->Session->read("User");
          unset($thisData["User"]["isSelectArea"]); //isSelectAreaを配列から削除
          $this->Session->delete("User");
          $this->request->data = $thisData; //地域を選んでconfirm→addでリダイレクトしたら$this->request->dataをaddで使える
        }
      }
    }

    if (!is_numeric($pref_id)) $pref_id = null;

    $this->set( 'select1', $this->Hobby->find( 'list', array(
      'fields' => array( 'id', 'hobby_name')
    )));
    $hobby = $this->Hobby->find( 'list', array(
      'fields' => array(
        'id', 'hobby_name'
      )));
    $prefecture = Configure::read("Prefecture");
    $thisPref = (!empty($pref_id))? $prefecture[$pref_id] : null;
    $areas = Configure::read("area");
    $this->set(compact("thisURL", "thisPref", "pref_id", "userData","hobby", "areas", "prefecture","thisURL"));
  }


  public function confirm() {
    $this->Session->write("User", $this->request->data["User"]);
    $hobbies = $this->request->data["User"]["hobby_name"];
    $hobbyList = $this->Hobby->find( 'list', [
      'fields' => ['id', 'hobby_name']
    ]);
    $hobbyLabel = "";
    if (!empty($hobbies)){
      foreach ($hobbies as $hobby){
        if (array_key_exists($hobby, $hobbyList)){
          $hobbyLabel .= $hobbyList[$hobby] . "　";
        }
      }
    }
    $prefecturelabel = "";
    $prefectureList = Configure::read("Prefecture");
    $prefNum = $prefectureList[$this->request->data["User"]["area"]];
    $userChoicePreNum = $this->request->data["User"]["prefecture"];
    $userChoicePrefecture = !empty($userChoicePreNum)? $prefNum[$userChoicePreNum] : 1;
    $userBirthDate = ($this->request->data["User"]["birthday"]);
    $now = date("Ymd");
    $birthday = str_replace("/", "", $userBirthDate);
    $birthday = str_replace("-", "", $birthday);
    $userAge = floor(($now-$birthday)/10000);

    $this->set(compact("hobbyLabel","editHobbyLabel", "areaLabel" ,"userChoicePrefecture","userAge"));

    if ($this->request->data["User"]["isSelectArea"]){ //もしisSelectAreaというキーを持っていれば
      $thisData = $this->request->data;
      $prefectureList = Configure::read("Prefecture");
      $prefNum = $prefectureList[$thisData["User"]["area"]];
      $userChoicePrefecture = $prefNum[1];
      $this->Session->delete("User");
      $this->Session->write("User",$thisData);
      $this->redirect(["action" => "add",$thisData["User"]["area"]]);

    }

  }



  public function send() {
    $this->autoLayout = false;
    $userData = $this->Session->read("User");  //addアクションでセッションを既に書き込んだので、ここで読み込みする。
    if ($this->request->is('post')) {
      $hobby_nameArray = $userData["hobby_name"];
      $userData["user_hobbies"] = !empty($hobby_nameArray)? implode("-", $hobby_nameArray) : null;
      $userChoiceArea = $userData['area'];
      $userChoicePref = $userData['prefecture'];
      $userHomeTownArray[] = $userChoiceArea;
      $userHomeTownArray[] = $userChoicePref;
      $userData["hometown"] = implode("-", $userHomeTownArray);
      if ($this->User->save($userData)) {
          $this->Session->setFlash('ユーザーを登録しました！');
          $this->Session->delete("User");
            $this->redirect(array('action'=>'index'));
      } else{
          $this->Session->setFlash('ユーザー登録に失敗しました！');
      }
    }
  }


  public function edit($id = null) {
    $userID = $this->User->id = $id;
    $editUserHometown = $this->User->find( 'list', [
      'fields' => ['id', 'hometown']
    ]);
    $hometownArr = explode("-",$editUserHometown[$userID]);
    $userAreNum = $hometownArr[0];
    $userPrefNum = $hometownArr[1];
    $this->set( 'select1', $this->Hobby->find('list', array(
      'fields' => array( 'id', 'hobby_name')
    )));
    $editUserhobby = $this->User->find( 'list', [
      'fields' => ['id', 'user_hobbies']
    ]);
    $editUserhobbyArr = explode("-", $editUserhobby[$userID]);
    foreach($editUserhobbyArr as $n => $editUserChoisedHobby){
      $hobbyNum = $editUserChoisedHobby;
    }

    $prefectureArr = Configure::read("Prefecture");
    $prefecture = $prefectureArr[$userAreNum];
    $areas = Configure::read("area");
    $this->set(compact("hobby", "areas", "prefecture","editUserhobbyArr","hobbyNum","prefectureArr","userAreNum","userPrefNum"));

    if ($this->request->is('get')) {
        $thisUser = $this->User->read();
        $thisUser['User']['user_hobbies'] = $editUserhobbyArr; //文字列から配列に変換して"user_hobbies"に返すことで、ビューで表示できるようにした
        $this->request->data = $thisUser;
    } else {
        $this->request->data['User']['user_hobbies'] = implode("-", $this->request->data['User']['user_hobbies']);
        $editUserArea = $this->request->data['User']['area'];
        $editUserPref = $this->request->data['User']['prefecture'];
        $editUserHometownArray[] = $editUserArea;
        $editUserHometownArray[] = $editUserPref;
        $this->request->data['User']['hometown'] = implode("-", $editUserHometownArray);
        // if($this->User->save($this->request->data['User'])) {
        //   $this->Session->setFlash('ユーザー情報を変更しました');
        //   $this->redirect(array('action'=>'index'));
        // } else {
        //   $this->Session->setFlash('ユーザー情報の変更に失敗しました！');
        // }
    }
  }


  public function delete($id) {
    $this->autoRender = false;
    if($this->request->is('get')) {
      throw new MethodNotAllowedException();
    }

    if($this->User->delete($id)) {
      $this->Session->setFlash('Delete!');
      $this->redirect(array('action'=>'index'));
    }else{
      debug(__LINE__);
    }
  }

}