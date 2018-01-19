<?php

class SupplierController extends Controller {

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
                $supplier = new Supplier;
                $supplier->nama_supplier = Yii::app()->request->getPost('nama_supplier');
                $supplier->alamat_supplier = Yii::app()->request->getPost('alamat_supplier');
                $supplier->nama_pemilik = Yii::app()->request->getPost('nama_pemilik');
                $supplier->no_telephone = Yii::app()->request->getPost('no_telephone');
                $supplier->no_fax = Yii::app()->request->getPost('no_fax');
                if ($supplier->save()) {
                    Yii::app()->user->setFlash('success', 'Data Supplier berhasil dimasukkan');
                } else {
                    print_r($supplier->getErrors());
                }
            } else if ($mode == 'update') {
                $id = Yii::app()->request->getPost('id_supplier');
                $supplier_edit = Supplier::model()->findByPk($id);
                $supplier_edit->nama_supplier = Yii::app()->request->getPost('nama_supplier');
                $supplier_edit->alamat_supplier = Yii::app()->request->getPost('alamat_supplier');
                $supplier_edit->nama_pemilik = Yii::app()->request->getPost('nama_pemilik');
                $supplier_edit->no_telephone = Yii::app()->request->getPost('no_telephone');
                $supplier_edit->no_fax = Yii::app()->request->getPost('no_fax');
                if ($supplier_edit->save()) {
                    Yii::app()->user->setFlash('success', 'Data Supplier berhasil dirubah');
                } else {
                    print_r($supplier->getErrors());
                }
            } else if ($mode == 'delete') {
                $id = Yii::app()->request->getPost('id');
                $supplier_delete = Supplier::model()->findByPk($id);
                $supplier_delete->delete();
            }
        }
        $data = Supplier::model()->findAll();
        $this->render('read', array(
            'data_supplier' => $data
        ));
    }

    public function actionUpdateAjax() {
        $id = Yii::app()->request->getQuery('id');
        $supplier = Supplier::model()->findByPk($id);

        $this->renderPartial('updateAjax', array(
            'supplier' => $supplier,
            'id_supplier' => $id
        ));
    }

  

}
