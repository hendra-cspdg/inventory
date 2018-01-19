<?php

class BarangController extends Controller {

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
                $barang = new Barang;
                $barang->id_satuan = Yii::app()->request->getPost('id_satuan');
                $barang->kode_barang = Yii::app()->request->getPost('kode_barang');
                $barang->nama_barang = Yii::app()->request->getPost('nama_barang');
                $barang->merk = Yii::app()->request->getPost('merk');
                $barang->deskripsi = json_encode(Yii::app()->request->getPost('deskripsi'));
                if ($barang->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dimasukkan');
                } else {
                    print_r($barang->getErrors());
                }
            } else if ($mode == 'update') {
                $id = Yii::app()->request->getPost('id_barang');
                $barang_edit = Barang::model()->findByPk($id);
                $barang_edit->id_satuan = Yii::app()->request->getPost('id_satuan');
                $barang_edit->kode_barang = Yii::app()->request->getPost('kode_barang');
                $barang_edit->nama_barang = Yii::app()->request->getPost('nama_barang');
                $barang_edit->merk = Yii::app()->request->getPost('merk');
                $barang_edit->deskripsi = json_encode(Yii::app()->request->getPost('deskripsi'));
                if ($barang_edit->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dirubah');
                } else {
                    print_r($barang->getErrors());
                }
            } else if ($mode == 'delete') {
                $id = Yii::app()->request->getPost('id');
                $barang_delete = Barang::model()->findByPk($id);
                $barang_delete->is_deleted=1;
                $barang_delete->save();
            }
        }
        $query_barang = "
             select b.*,s.nama_satuan
             from barang b
             left join satuan s on s.id_satuan=b.id_satuan
             where b.is_deleted='0'
             order by b.nama_barang
             ";
        $data = Yii::app()->db->createCommand($query_barang)->queryAll();
        $this->render('read', array(
            'data_barang' => $data,
            'data_satuan' => Satuan::model()->findAll(),
        ));
    }

    public function actionUpdateAjax() {
        $id = Yii::app()->request->getQuery('id');
        $barang = Barang::model()->findByPk($id);

        $this->renderPartial('updateAjax', array(
            'barang' => $barang,
            'data_satuan' => Satuan::model()->findAll(),
            'id_barang' => $id
        ));
    }

}

