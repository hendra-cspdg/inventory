<?php

class ManualController extends Controller {

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
                'actions' => array('read', 'view', 'create', 'update', 'delete', 'pilihBarangDetailAjax','updateBarangDetailAjax', 'saveByField'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    private function getDetailBarang($id) {
        $query_barang = "
            SELECT ttd.*,b.nama_barang,b.kode_barang,b.deskripsi,s.nama_satuan
            FROM tanda_terima_detail ttd
            join barang b on b.id_barang=ttd.id_barang
            join satuan s on s.id_satuan=b.id_satuan
            where ttd.id_tanda_terima='{$id}' and ttd.is_deleted='0' 
            order by b.nama_barang
            ";
        return Yii::app()->db->createCommand($query_barang)->queryAll();
    }
    
    /**
     * Declares class-based actions.
     */
    public function actionRead() {
        if (!empty($_POST['id'])) {
            $model = TandaTerima::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->is_deleted = 1;
            $model->save();
        }
        $arr_data = array();
        $query_view = "
            SELECT tt.*, sp.nama_supplier
            FROM tanda_terima tt
            join supplier sp on sp.id_supplier=tt.id_supplier
            where tt.tgl_terima is not null and tt.is_saved=1 and tt.is_deleted=0 and tt.is_po='0'
            order BY tt.tgl_terima desc
            ";
        $data_view = Yii::app()->db->createCommand($query_view)->queryAll();
        foreach ($data_view as $d) {

            array_push($arr_data, array_merge($d, array('data_barang' => $this->getDetailBarang($d['id_tanda_terima']))));
        }
        $this->render('read', array(
            'data' => $arr_data
        ));
    }

    public function actionCreate() {
        $jumlah_data = TandaTerima::model()->countBySql("select count(*) from tanda_terima where is_saved='1' and is_po='0'") + 1;
        $format_nomor_ttm = str_pad($jumlah_data.'M', 10, "0", STR_PAD_LEFT);
        //cek data ada
        $tanda_terima_data = TandaTerima::model()->findByAttributes(array('kode_sistem' => $format_nomor_ttm));
        if (empty($tanda_terima_data)) {
            $tanda_terima_data = new TandaTerima;
            $tanda_terima_data->kode_sistem = $format_nomor_ttm;
            $tanda_terima_data->waktu_sistem = date('Y-m-d H:i:s');
            $tanda_terima_data->is_po=0;
            $tanda_terima_data->save();
        }

        if (!empty($_POST)) {
            $mode = Yii::app()->request->getPost('mode');
            if ($mode == 'tambah-barang') {
                $tanda_terima_detail = new TandaTerimaDetail;
                $tanda_terima_detail->id_tanda_terima = $tanda_terima_data['id_tanda_terima'];
                $tanda_terima_detail->id_barang = Yii::app()->request->getPost('id_barang');
                $tanda_terima_detail->jumlah_barang = 0;
                $tanda_terima_detail->jumlah_terima = Yii::app()->request->getPost('jumlah_terima');
                $tanda_terima_detail->harga_terima = Yii::app()->request->getPost('harga_terima');
                $tanda_terima_detail->harga_satuan = 0;
                $tanda_terima_detail->harga_total = Yii::app()->request->getPost('harga_total');
                $tanda_terima_detail->keterangan = Yii::app()->request->getPost('keterangan');
                $tanda_terima_detail->save();
            } else if ($mode == 'update-barang') {
                $id_pbd = Yii::app()->request->getPost('id_bd');
                $tanda_terima_detail = TandaTerimaDetail::model()->findByPk($id_pbd);
                if (Yii::app()->request->getPost('barang') == '') {
                    $tanda_terima_detail->id_barang = Yii::app()->request->getPost('id_barang');
                } else {
                    $tanda_terima_detail->id_barang = Yii::app()->request->getPost('barang');
                }
                $tanda_terima_detail->jumlah_terima = Yii::app()->request->getPost('jumlah_terima');
                $tanda_terima_detail->harga_terima = Yii::app()->request->getPost('harga_terima');
                $tanda_terima_detail->harga_total = Yii::app()->request->getPost('harga_total');
                $tanda_terima_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($tanda_terima_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil diubah');
                } else {
                    print_r($tanda_terima_detail->getErrors());
                }
            } else if ($mode == 'pilih-barang') {
                $arr_pod = Yii::app()->request->getPost('id_pod');
                if (count($arr_pod) > 0) {
                    Yii::app()->db->createCommand("delete from tanda_terima_detail where id_tanda_terima='{$tanda_terima_data['id_tanda_terima']}'")->query();
                    $indx = 0;
                    foreach ($arr_pod as $idp) {
                        $pod = PurchasingOrderDetail::model()->findByPk($idp);
                        $tanda_terima_detail = new TandaTerimaDetail;
                        $tanda_terima_detail->id_tanda_terima = $tanda_terima_data['id_tanda_terima'];
                        $tanda_terima_detail->id_barang = $pod->id_barang;
                        $tanda_terima_detail->jumlah_barang = Yii::app()->request->getPost('jumlah_barang_' . $idp);
                        $tanda_terima_detail->jumlah_terima = Yii::app()->request->getPost('jumlah_terima_' . $idp);
                        $tanda_terima_detail->harga_satuan = Yii::app()->request->getPost('harga_satuan_' . $idp);
                        $tanda_terima_detail->harga_terima = Yii::app()->request->getPost('harga_terima_' . $idp);
                        $tanda_terima_detail->harga_total = Yii::app()->request->getPost('harga_total_' . $idp);
                        $tanda_terima_detail->keterangan = Yii::app()->request->getPost('keterangan_' . $idp);
                        $tanda_terima_detail->save();
                        $indx++;
                    }
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil tambah');
                }
            } else if ($mode == 'hapus-barang') {
                $id_ttd = Yii::app()->request->getPost('id_ttd');
                $tanda_terima_detail = TandaTerimaDetail::model()->findByPk($id_ttd);
                $tanda_terima_detail->is_deleted = 1;
                $tanda_terima_detail->save();
            } else if ($mode == 'update-tanda-terima') {
                $tanda_terima = TandaTerima::model()->findByAttributes(array('id_tanda_terima' => $tanda_terima_data['id_tanda_terima']));
                $tanda_terima->is_saved = 1;

                if ($tanda_terima->save()) {
                    Yii::app()->user->setFlash('success', 'Data Tanda Terima berhasil dimasukkan');
                } else {
                    print_r($tanda_terima->getErrors());
                }
                $this->redirect('update?id_tt=' . $tanda_terima->id_tanda_terima);
            }
        }
        $data_barang_detail = $this->getDetailBarang($tanda_terima_data['id_tanda_terima']);
        $data_supplier = Supplier::model()->findAll();

        $this->render('create', array(
            'tanda_terima' => $tanda_terima_data,
            'format_nomor_ttm' => $format_nomor_ttm,
            'data_barang_detail' => $data_barang_detail,
            'data_supplier' => $data_supplier,
            'data_proyek' => Proyek::model()->findAll()
        ));
    }

    public function actionUpdate() {
        $id_tt = Yii::app()->request->getParam('id_tt');
        $tanda_terima_data = TandaTerima::model()->findByAttributes(array('id_tanda_terima' => $id_tt));


        if (!empty($_POST)) {
            $mode = Yii::app()->request->getPost('mode');
            if ($mode == 'tambah-barang') {
                $tanda_terima_cek = TandaTerimaDetail::model()->findByAttributes(array('id_barang' => Yii::app()->request->getPost('id_barang'), 'harga_satuan' => Yii::app()->request->getPost('harga')));
                $tanda_terima_detail = new TandaTerimaDetail;
                $tanda_terima_detail->id_tanda_terima = $tanda_terima_data['id_tanda_terima'];
                $tanda_terima_detail->id_barang = Yii::app()->request->getPost('id_barang');
                $tanda_terima_detail->jumlah_barang = 0;
                $tanda_terima_detail->jumlah_terima = Yii::app()->request->getPost('jumlah_terima');
                $tanda_terima_detail->harga_terima = Yii::app()->request->getPost('harga_terima');
                $tanda_terima_detail->harga_satuan = 0;
                $tanda_terima_detail->harga_total = Yii::app()->request->getPost('harga_total');
                $tanda_terima_detail->keterangan = Yii::app()->request->getPost('keterangan');
                $tanda_terima_detail->save();
            } else if ($mode == 'update-barang') {
                $id_pbd = Yii::app()->request->getPost('id_bd');
                $tanda_terima_detail = TandaTerimaDetail::model()->findByPk($id_pbd);
                if (Yii::app()->request->getPost('barang') == '') {
                    $tanda_terima_detail->id_barang = Yii::app()->request->getPost('id_barang');
                } else {
                    $tanda_terima_detail->id_barang = Yii::app()->request->getPost('barang');
                }
                $tanda_terima_detail->jumlah_terima = Yii::app()->request->getPost('jumlah_terima');
                $tanda_terima_detail->harga_terima = Yii::app()->request->getPost('harga_terima');
                $tanda_terima_detail->harga_total = Yii::app()->request->getPost('harga_total');
                $tanda_terima_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($tanda_terima_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil diubah');
                } else {
                    print_r($tanda_terima_detail->getErrors());
                }
            } else if ($mode == 'pilih-barang') {
                $arr_pod = Yii::app()->request->getPost('id_pod');
                if (count($arr_pod) > 0) {
                    Yii::app()->db->createCommand("delete from tanda_terima_detail where id_tanda_terima='{$tanda_terima_data['id_tanda_terima']}'")->query();
                    $indx = 0;
                    foreach ($arr_pod as $idp) {
                        $pod = PurchasingOrderDetail::model()->findByPk($idp);
                        $tanda_terima_detail = new TandaTerimaDetail;
                        $tanda_terima_detail->id_tanda_terima = $tanda_terima_data['id_tanda_terima'];
                        $tanda_terima_detail->id_barang = $pod->id_barang;
                        $tanda_terima_detail->jumlah_barang = Yii::app()->request->getPost('jumlah_barang_' . $idp);
                        $tanda_terima_detail->jumlah_terima = Yii::app()->request->getPost('jumlah_terima_' . $idp);
                        $tanda_terima_detail->harga_satuan = Yii::app()->request->getPost('harga_satuan_' . $idp);
                        $tanda_terima_detail->harga_terima = Yii::app()->request->getPost('harga_terima_' . $idp);
                        $tanda_terima_detail->harga_total = Yii::app()->request->getPost('harga_total_' . $idp);
                        $tanda_terima_detail->keterangan = Yii::app()->request->getPost('keterangan_' . $idp);
                        $tanda_terima_detail->save();
                        $indx++;
                    }
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil tambah');
                }
            } else if ($mode == 'hapus-barang') {
                $id_ttd = Yii::app()->request->getPost('id_ttd');
                $tanda_terima_detail = TandaTerimaDetail::model()->findByPk($id_ttd);
                $tanda_terima_detail->is_deleted = 1;
                $tanda_terima_detail->save();
            } else if ($mode == 'update-tanda-terima') {
                $tanda_terima = TandaTerima::model()->findByAttributes(array('id_tanda_terima' => $tanda_terima_data['id_tanda_terima']));
                $tanda_terima->is_saved = 1;

                if ($tanda_terima->save()) {
                    Yii::app()->user->setFlash('success', 'Data Tanda Terima berhasil dimasukkan');
                } else {
                    print_r($tanda_terima->getErrors());
                }
                $this->redirect('update?id_tt=' . $tanda_terima->id_tanda_terima);
            }
        }
        $data_barang_detail = $this->getDetailBarang($tanda_terima_data['id_tanda_terima']);
        $data_supplier = Supplier::model()->findAll();

        $this->render('update', array(
            'tanda_terima' => $tanda_terima_data,
            'data_barang_detail' => $data_barang_detail,
            'data_supplier' => $data_supplier,
            'data_proyek' => Proyek::model()->findAll()
        ));
    }

    

    public function actionUpdateBarangDetailAjax() {
        $id = Yii::app()->request->getQuery('id');
        $query_barang = "
            SELECT ttd.*,b.nama_barang,b.kode_barang,b.deskripsi,s.nama_satuan
            FROM tanda_terima_detail ttd
            join barang b on b.id_barang=ttd.id_barang
            join satuan s on s.id_satuan=b.id_satuan
            where ttd.id_tanda_terima_detail='{$id}' 
            order by b.nama_barang
            ";
        $barang = Yii::app()->db->createCommand($query_barang)->queryRow();
        $this->renderPartial('updateBarangDetailAjax', array(
            'ttd' => $barang,
        ));
    }

    public function actionCetak() {
        $id = Yii::app()->request->getParam('id');
        $query_view = "
            SELECT po.*, sp.*
            FROM purchasing_order po
            left join supplier sp on sp.id_supplier=po.id_supplier
            where po.id_purchasing_order='{$id}'
            ";
        $data_view = Yii::app()->db->createCommand($query_view)->queryRow();

        // PRINT PDF
        $mpdf = Yii::app()->ePdf->mpdf();

        $mpdf->SetHTMLHeader('<div style="text-align: center; width:100%">{PAGENO}</div>');
        # render (full page)
        $mpdf->WriteHTML($this->renderPartial('cetak', array(
                    'purchasing_order' => $data_view,
                    'data_barang_detail' => $this->getBarangDetail($id)
                        )
                        , true)
        );
        $mpdf->Output();
    }

    public function actionSaveByField() {
        if (!empty($_POST)) {
            $coloumn = Yii::app()->request->getParam('name');
            $pk = Yii::app()->request->getParam('pk');
            $value = Yii::app()->request->getParam('value');
            TandaTerima::model()->updateByPk($pk, array($coloumn => $value));
        }
    }

}
