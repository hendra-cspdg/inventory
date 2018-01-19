<?php

class UserController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('read', 'view', 'create', 'update', 'delete','saveByField'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    private function Delete($id) {
        Yii::app()->db->createCommand("delete from user where id_user='{$id}' ")->query();
    }

	private function getParentDetail($id) {
        $query_barang = "
		select m.*,tm.id_template
		from template_menu tm join menu m
		on tm.id_menu=m.id_menu
		where tm.id_template='{$id}'
		order by m.id_parent_menu";
        return Yii::app()->db->createCommand($query_barang)->queryAll();
    }
	
	
    /**
     * Declares class-based actions.
     */
    public function actionRead() {
		if (!empty($_POST)) {
            $mode = Yii::app()->request->getPost('mode');
            if ($mode == 'tambah') {
                $user = new User;
                $user->id_role = Yii::app()->request->getPost('id_role');
                $user->nama_user = Yii::app()->request->getPost('nama_user');
                $user->username = Yii::app()->request->getPost('username');
				$salt = openssl_random_pseudo_bytes(22);
				$salt = 'inventory' . strtr($salt, array('_' => '.', '~' => '/'));				
				$password_hash = crypt(Yii::app()->request->getPost('password'), $salt);
                $user->password = $password_hash;
				$user->email = Yii::app()->request->getPost('email');
				$user->tgl_lahir = Yii::app()->request->getPost('tgl_lahir');
                if ($user->save() && $template_user->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dimasukkan');
                } else {
                    print_r($user->getErrors());
                }
            } else if ($mode == 'update') {
                $id = Yii::app()->request->getPost('id_user');
				$user_edit = User::model()->findByPk($id);
                $user_edit->id_role = Yii::app()->request->getPost('id_role');
                $user_edit->nama_user = Yii::app()->request->getPost('nama_user');
                $user_edit->username = Yii::app()->request->getPost('username');
				$salt = openssl_random_pseudo_bytes(22);
				$salt = 'inventory' . strtr($salt, array('_' => '.', '~' => '/'));				
				$password_hash = crypt(Yii::app()->request->getPost('password'), $salt);
                $user_edit->password = $password_hash;
				$user_edit->email = Yii::app()->request->getPost('email');
				$user_edit->tgl_lahir = Yii::app()->request->getPost('tgl_lahir');
                if ($user_edit->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dirubah');
                } else {
                    print_r($user->getErrors());
                }
            } else if ($mode == 'delete') {
                $id = Yii::app()->request->getPost('id');
                $this->Delete($id);
            }

        }		
		$arr_data = array();
		$query_view = "SELECT r.* FROM user r where not r.id_user=1 ORDER BY r.id_role";
        $data_view = Yii::app()->db->createCommand($query_view)->queryAll();
        foreach ($data_view as $d) {
			array_push($arr_data, array_merge($d, array('data_parent' => $this->getParentDetail($d['id_user']))));
        }
        $this->render('read', array(
            'data_personil' => $arr_data
        ));
    }	

	public function actionUpdate() {
		$id = Yii::app()->request->getQuery('id');
        $barang = User::model()->findByPk($id);

        $this->renderPartial('update', array(
            'barang' => $barang,
			'id_user' => $id
        ));
    }

}
   