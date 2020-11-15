<?php

class HobbiesController extends AppController {
  public $helpers = array('Html', 'Form');
  public $uses = ['User','Hobby'];   //UsersコントローラーでHobbyモデルが使えるように宣言する
  public $components = array('Session');  //セッションを使えるようにする



  public function index(){
    $this->set('hobbies', $this->Hobby->find('all'));
  }
  
  public function add(){

  }

  public function confirm(){

    $this->Session->write("Hobby", $this->request->data["Hobby"]);    
  }

  public function send() {
    $this->autoLayout = false;
    $HobbyData = $this->Session->read("Hobby");  //addアクションでセッションを既に書き込んだので、ここで読み込みする。
    if ($this->request->is('post')) {
        // debug($HobbyData);!die;
      if ($this->Hobby->save($HobbyData)) {
          $this->Session->setFlash('趣味を新たに登録しました！');
            $this->redirect(array('action'=>'index'));
      } else{
          $this->Session->setFlash('趣味の登録に失敗しました！');
      }
    }
  }

  public function edit($id = null) {
  
    $this->Hobby->id = $id;
    $this->set('hobby', $this->Hobby->read());
  
    if ($this->request->is('get')) {
      $this->request->data = $this->Hobby->read();
    } else {
      if($this->Hobby->save($this->request->data['Hobby'])) {
        $this->Session->setFlash('趣味名を変更しました');
        $this->redirect(array('action'=>'index'));
      } else {
        $this->Session->setFlash('趣味名の変更に失敗しました！');
      } 
    }

  }

  public function delete($id) {
    $this->autoRender = false;
    if($this->request->is('get')) {
      throw new MethodNotAllowedException();
    }
    
    if($this->Hobby->delete($id)) {
      $this->Session->setFlash('Delete!');
      $this->redirect(array('action'=>'index'));
    }else{
      debug(__LINE__);
    }
  }

}