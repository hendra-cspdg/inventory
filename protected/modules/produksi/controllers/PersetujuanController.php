<?php

class PersetujuanController extends Controller {

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
                'actions' => array('read', 'view', 'setujui', 'update', 'delete'),
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
        $query_permintaan_barang = "
             select pb.*,pr.nama_proyek,per.nama_perusahaan
             from permintaan_barang pb
             join proyek pr on pr.id_proyek=pb.id_proyek
             join perusahaan per on per.id_perusahaan=pr.id_perusahaan
             order by pb.tgl_permintaan desc
             ";
        $data_permintaan_barang = Yii::app()->db->createCommand($query_permintaan_barang)->queryAll();
        $this->render('read', array(
            'data' => $data_permintaan_barang
        ));
    }

    public function actionSetujui() {
        $id_permintaan = Yii::app()->request->getParam('id');
        $permintaan_barang = PermintaanBarang::model()->findByPk($id_permintaan);
        if (!empty($_POST)) {
            $permintaan_barang->id_peg_apv = Yii::app()->user->id;
            $permintaan_barang->save();
            if ($permintaan_barang->save()) {
                Yii::app()->user->setFlash('success', 'Data Permintaan berhasil disetujui');
            } else {
                print_r($permintaan_barang->getErrors());
            }
        }
        $query_proyek = "
            select pr.* ,ph.nama_perusahaan
            from proyek pr
            join perusahaan ph on ph.id_perusahaan=pr.id_perusahaan
            order by pr.nama_proyek
            ";
        $data_proyek = Yii::app()->db->createCommand($query_proyek)->queryAll();
        $query_barang = "
            select b.* ,s.nama_satuan
            from barang b
            join satuan s on s.id_satuan=b.id_satuan
            order by b.nama_barang
            ";
        $data_barang = Yii::app()->db->createCommand($query_barang)->queryAll();
        $query_barang_detail = "
            select pbd.*,b.nama_barang ,s.nama_satuan,sp.nama_supplier
            from permintaan_barang_detail pbd
            join barang b on b.id_barang=pbd.id_barang
            join satuan s on s.id_satuan=b.id_satuan
            left join supplier sp on sp.id_supplier = pbd.id_supplier
            where pbd.id_permintaan_barang='{$id_permintaan}'
            order by pbd.id_permintaan_barang_detail
            ";
        $data_barang_detail = Yii::app()->db->createCommand($query_barang_detail)->queryAll();
        $data_supplier = Supplier::model()->findAll();
        $this->render('setujui', array(
            'id_permintaan' => $id_permintaan,
            'permintaan_barang' => $permintaan_barang,
            'data_barang_detail' => $data_barang_detail,
            'data_proyek' => $data_proyek,
            'data_barang' => $data_barang,
            'data_supplier' => $data_supplier
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
