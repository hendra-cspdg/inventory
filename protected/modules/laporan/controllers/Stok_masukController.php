<?php

class Stok_masukController extends Controller {

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
        $arr_data = array();
        $query_view = "
            SELECT po.*, sp.nama_supplier
            FROM purchasing_order po
            join supplier sp on sp.id_supplier=po.id_supplier
            where po.tgl_terima is not null
            order BY po.tgl_terima desc
            ";
        $data_view = Yii::app()->db->createCommand($query_view)->queryAll();
        foreach ($data_view as $d) {
            $query_barang = "
            SELECT pod.*,b.nama_barang,b.deskripsi,s.nama_satuan
            FROM purchasing_order_detail pod
            join barang b on b.id_barang=pod.id_barang
            join satuan s on s.id_satuan=b.id_satuan
            order by b.nama_barang
            ";
            $data_barang = Yii::app()->db->createCommand($query_barang)->queryAll();
            array_push($arr_data, array_merge($d,array('data_barang'=>$data_barang)));
        }
        $this->render('read', array(
            'data' => $arr_data
        ));
    }

}
