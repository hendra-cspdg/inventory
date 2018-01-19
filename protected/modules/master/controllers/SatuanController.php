<?php

class SatuanController extends Controller {

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
                'actions' => array('read', 'updateAjax', 'create', 'update', 'delete'),
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
        if (!empty($_POST)) {
            $mode = Yii::app()->request->getPost('mode');
            if ($mode == 'tambah') {
                $satuan = new Satuan;
                $satuan->nama_satuan = Yii::app()->request->getPost('nama_satuan');
                if ($satuan->save()) {
                    Yii::app()->user->setFlash('success', 'Data Satuan berhasil dimasukkan');
                } else {
                    print_r($satuan->getErrors());
                }
            } else if ($mode == 'update') {
                $id = Yii::app()->request->getPost('id_satuan');
                $satuan_edit = Satuan::model()->findByPk($id);
                $satuan_edit->nama_satuan = Yii::app()->request->getPost('nama_satuan');
                if ($satuan_edit->save()) {
                    Yii::app()->user->setFlash('success', 'Data Satuan berhasil dirubah');
                } else {
                    print_r($satuan->getErrors());
                }
            } else if ($mode == 'delete') {
                $id = Yii::app()->request->getPost('id');
                $satuan_delete = Satuan::model()->findByPk($id);
                $satuan_delete->delete();
            }
        }
        $data = Satuan::model()->findAll();
        $this->render('read', array(
            'data_satuan' => $data
        ));
    }

    public function actionUpdateAjax() {
        $id = Yii::app()->request->getQuery('id');
        $satuan = Satuan::model()->findByPk($id);

        $this->renderPartial('updateAjax', array(
            'satuan' => $satuan,
            'id_satuan' => $id
        ));
    }

   

}
