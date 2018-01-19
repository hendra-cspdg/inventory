<?php

class ProyekController extends Controller {

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
                $supplier = new Proyek;
                $supplier->nama_perusahaan = Yii::app()->request->getPost('nama_perusahaan');
                $supplier->nama_proyek = Yii::app()->request->getPost('nama_proyek');
                $supplier->alamat_proyek = Yii::app()->request->getPost('alamat_proyek');
                if ($supplier->save()) {
                    Yii::app()->user->setFlash('success', 'Data Supplier berhasil dimasukkan');
                } else {
                    print_r($supplier->getErrors());
                }
            } else if ($mode == 'update') {
                $id = Yii::app()->request->getPost('id_proyek');
                $supplier_edit = Proyek::model()->findByPk($id);
                $supplier_edit->nama_perusahaan = Yii::app()->request->getPost('nama_perusahaan');
                $supplier_edit->nama_proyek = Yii::app()->request->getPost('nama_proyek');
                $supplier_edit->alamat_proyek = Yii::app()->request->getPost('alamat_proyek');
                if ($supplier_edit->save()) {
                    Yii::app()->user->setFlash('success', 'Data Proyek berhasil dirubah');
                } else {
                    print_r($supplier->getErrors());
                }
            } else if ($mode == 'delete') {
                $id = Yii::app()->request->getPost('id');
                $supplier_delete = Proyek::model()->findByPk($id);
                $supplier_delete->delete();
            }
        }
        $data = Proyek::model()->findAll();
        $this->render('read', array(
            'data_proyek' => $data
        ));
    }

    public function actionUpdateAjax() {
        $id = Yii::app()->request->getQuery('id');
        $proyek = Proyek::model()->findByPk($id);

        $this->renderPartial('updateAjax', array(
            'proyek' => $proyek,
            'id_proyek' => $id
        ));
    }

  

}
