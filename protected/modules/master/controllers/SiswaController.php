<?php

class SiswaController extends Controller {

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
                'actions' => array('read', 'view', 'create', 'update', 'delete'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Declares class-based actions.
     */
    public function actionRead() {
        $query_view = "
            select s.*,k.nama_kota,ag.nama_agama
            from siswa s
            left join kota k on k.id_kota=s.id_kota_lahir
            left join agama ag on ag.id_agama=s.id_agama
            order by s.nama_siswa
            ";
        $data_siswa = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('read', array(
            'data_siswa' => $data_siswa
        ));
    }

    public function actionView($id) {
        $id = Yii::app()->request->getQuery('id');
        $siswa = Siswa::model()->findByPk($id);

        $data_propinsi = Propinsi::model()->findAll();
        $data_agama = Agama::model()->findAll();
        $this->render('view', array(
            'siswa' => $siswa,
            'data_propinsi' => $data_propinsi,
            'data_agama' => $data_agama
        ));
    }

    public function actionCreate() {
        if (!empty($_POST)) {
            $siswa = new Siswa;
            $siswa->nama_siswa = Yii::app()->request->getPost('nama');
            $siswa->tgl_lahir = Yii::app()->request->getPost('tgl_lahir');
            $siswa->id_kota_lahir = Yii::app()->request->getPost('kota');
            $siswa->jenis_kelamin = Yii::app()->request->getPost('jenis_kelamin');
            $siswa->nama_ortu = Yii::app()->request->getPost('nama_ortu');
            $siswa->pekerjaan_ortu = Yii::app()->request->getPost('pekerjaan_ortu');
            $siswa->id_agama = Yii::app()->request->getPost('agama');
            $siswa->kekhususan = Yii::app()->request->getPost('kekhususan');
            $siswa->alamat = Yii::app()->request->getPost('alamat');
            $siswa->alamat_latitude = Yii::app()->request->getPost('lat');
            $siswa->alamat_longitude = Yii::app()->request->getPost('long');
            if ($siswa->save()) {
                Yii::app()->user->setFlash('success', 'Data Siswa berhasil dimasukkan');
            } else {
                print_r($siswa->getErrors());
            }
        }
        $data_propinsi = Propinsi::model()->findAll();
        $data_agama = Agama::model()->findAll();
        $this->render('create', array(
            'data_propinsi' => $data_propinsi,
            'data_agama' => $data_agama
        ));
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $siswa = Siswa::model()->findByPk($id);
        if (!empty($_POST)) {
            $siswa->nama_siswa = Yii::app()->request->getPost('nama');
            $siswa->tgl_lahir = Yii::app()->request->getPost('tgl_lahir');
            $siswa->id_kota_lahir = Yii::app()->request->getPost('kota');
            $siswa->jenis_kelamin = Yii::app()->request->getPost('jenis_kelamin');
            $siswa->nama_ortu = Yii::app()->request->getPost('nama_ortu');
            $siswa->pekerjaan_ortu = Yii::app()->request->getPost('pekerjaan_ortu');
            $siswa->id_agama = Yii::app()->request->getPost('agama');
            $siswa->kekhususan = Yii::app()->request->getPost('kekhususan');
            $siswa->alamat = Yii::app()->request->getPost('alamat');
            $siswa->alamat_latitude = Yii::app()->request->getPost('lat');
            $siswa->alamat_longitude = Yii::app()->request->getPost('long');
            if ($siswa->save()) {
                Yii::app()->user->setFlash('success', 'Data Siswa berhasil dirubah');
            } else {
                print_r($siswa->getErrors());
            }
        }
        $data_propinsi = Propinsi::model()->findAll();
        $data_agama = Agama::model()->findAll();
        $this->render('update', array(
            'siswa' => $siswa,
            'data_propinsi' => $data_propinsi,
            'data_agama' => $data_agama
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = Siswa::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }

}
