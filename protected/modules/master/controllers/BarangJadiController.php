<?php

class BarangJadiController extends Controller {

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
                $barang_jadi = new BarangJadi;
                $barang_jadi->id_satuan = Yii::app()->request->getPost('id_satuan');
                $barang_jadi->kode_barang_jadi = Yii::app()->request->getPost('kode_barang_jadi');
                $barang_jadi->nama_barang_jadi = Yii::app()->request->getPost('nama_barang_jadi');
                $barang_jadi->deskripsi = json_encode(Yii::app()->request->getPost('deskripsi'));
                if ($barang_jadi->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dimasukkan');
                } else {
                    print_r($barang_jadi->getErrors());
                }
            } else if ($mode == 'update') {
                $id = Yii::app()->request->getPost('id_barang_jadi');
                $barang_jadi_edit = BarangJadi::model()->findByPk($id);
                $barang_jadi_edit->id_satuan = Yii::app()->request->getPost('id_satuan');
                $barang_jadi_edit->kode_barang_jadi = Yii::app()->request->getPost('kode_barang_jadi');
                $barang_jadi_edit->nama_barang_jadi = Yii::app()->request->getPost('nama_barang_jadi');
                $barang_jadi_edit->harga = Yii::app()->request->getPost('harga');
                $barang_jadi_edit->deskripsi = json_encode(Yii::app()->request->getPost('deskripsi'));
                if ($barang_jadi_edit->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dirubah');
                } else {
                    print_r($barang_jadi->getErrors());
                }
            } else if ($mode == 'delete') {
                $id = Yii::app()->request->getPost('id');
                $barang_jadi_delete = BarangJadi::model()->findByPk($id);
                $barang_jadi_delete->is_delected=1;
                $barang_jadi_delete->save();
            }
        }
        $query_barang = "
             select b.*,s.nama_satuan
             from barang_jadi b
             left join satuan s on s.id_satuan=b.id_satuan
             where b.is_delected='0'
             order by b.nama_barang_jadi
             ";
        $data = Yii::app()->db->createCommand($query_barang)->queryAll();
        $this->render('read', array(
            'data_barang_jadi' => $data,
            'data_satuan' => Satuan::model()->findAll(),
        ));
    }

    public function actionUpdateAjax() {
        $id = Yii::app()->request->getQuery('id');
        $barang_jadi = BarangJadi::model()->findByPk($id);

        $this->renderPartial('updateAjax', array(
            'barang_jadi' => $barang_jadi,
            'data_satuan' => Satuan::model()->findAll(),
            'id_barang_jadi' => $id
        ));
    }

}

