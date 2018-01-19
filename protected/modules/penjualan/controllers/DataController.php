<?php

class DataController extends Controller {

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
                'actions' => array('read', 'readPersetujuan', 'view', 'create', 'update', 'updateBarangDetailAjax', 'delete', 'setujui', 'saveByField', 'cetak'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    private function clearGarbageData() {
        Yii::app()->db->createCommand("delete from penjualan  where is_saved=0 and is_deleted=0 and nomor_penjualan is null")->query();
        Yii::app()->db->createCommand("delete from penjualan_detail  where id_penjualan not in (select id_penjualan from penjualan)")->query();
    }

    private function getBarangDetail($id) {
        $query_barang = "
            SELECT pbd.*,b.nama_barang_jadi,b.kode_barang_jadi,b.harga,b.deskripsi,s.nama_satuan
            FROM penjualan_detail pbd
            join barang_jadi b on b.id_barang_jadi=pbd.id_barang_jadi
			join satuan s on b.id_satuan=s.id_satuan
            where pbd.id_penjualan='{$id}'  and pbd.is_deleted='0'
            order by b.nama_barang_jadi
            ";
        return Yii::app()->db->createCommand($query_barang)->queryAll();
    }

    /**
     * Declares class-based actions.
     */
    public function actionRead() {
        $this->clearGarbageData();
        if (!empty($_POST['id'])) {
            $model = Penjualan::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->is_deleted = 1;
            $model->save();
        }
        $arr_data = array();
        $query_view = "
            SELECT pb.*
            FROM penjualan pb
            where pb.is_saved=1 and pb.is_deleted=0
            order BY pb.tgl_penjualan desc
            ";
        $data_view = Yii::app()->db->createCommand($query_view)->queryAll();
        foreach ($data_view as $d) {
            array_push($arr_data, array_merge($d, array('data_barang' => $this->getBarangDetail($d['id_penjualan']))));
        }
        $this->render('read', array(
            'data' => $arr_data
        ));
    }

    public function actionReadPersetujuan() {
        $this->clearGarbageData();
        $arr_data = array();
        $query_view = "
            SELECT pb.*, p.nama_proyek
            FROM penjualan pb
            left join proyek p on p.id_proyek=pb.id_proyek
            where pb.is_saved=1 and pb.is_deleted=0
            order BY pb.tgl_permintaan desc
            ";
        $data_view = Yii::app()->db->createCommand($query_view)->queryAll();
        foreach ($data_view as $d) {
            array_push($arr_data, array_merge($d, array('data_barang' => $this->getBarangDetail($d['id_penjualan']))));
        }
        $this->render('readPersetujuan', array(
            'data' => $arr_data
        ));
    }

    public function actionCreate() {	
        $jumlah_data = Penjualan::model()->countBySql("select count(*) from penjualan where is_saved = 1") + 1;
        $format_nomor_penjualan = str_pad($jumlah_data, 10, "0", STR_PAD_LEFT);
        //cek data ada
        $penjualan_data = Penjualan::model()->findByAttributes(array('kode_sistem' => $format_nomor_penjualan));
        if (empty($penjualan_data)) {
            $penjualan_data = new Penjualan;
            $penjualan_data->kode_sistem = $format_nomor_penjualan;
            $penjualan_data->waktu_sistem = date('Y-m-d H:i:s');
            $penjualan_data->save();
        }

        if (!empty($_POST)) {
             $mode = Yii::app()->request->getPost('mode');
            if ($mode == 'tambah-barang') {
                $penjualan_detail = new PenjualanDetail;
                $penjualan_detail->id_penjualan = $penjualan_data['id_penjualan'];
                $penjualan_detail->id_barang_jadi = Yii::app()->request->getPost('barang');		
                $penjualan_detail->jumlah_barang = Yii::app()->request->getPost('jumlah');
                $penjualan_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($penjualan_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dimasukkan');
                } else {
                    print_r($penjualan_detail->getErrors());
                }
            } else if ($mode == 'update-barang') {
                $id_pbd = Yii::app()->request->getPost('id_bd');
                $penjualan_detail = PenjualanDetail::model()->findByPk($id_pbd);
                if (Yii::app()->request->getPost('barang') == '') {
                    $penjualan_detail->id_barang_jadi = Yii::app()->request->getPost('id_barang');
                } else {
                    $penjualan_detail->id_barang_jadi = Yii::app()->request->getPost('barang');
                }
                $penjualan_detail->jumlah_barang = Yii::app()->request->getPost('jumlah');
                $penjualan_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($penjualan_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil diubah');
                } else {
                    print_r($penjualan_detail->getErrors());
                }
            } else if ($mode == 'hapus-barang') {
                $id_pbd = Yii::app()->request->getPost('id_bd');
                $penjualan_detail = PenjualanDetail::model()->findByPk($id_pbd);
                $penjualan_detail->is_deleted = 1;
                if ($penjualan_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dihapus');
                } else {
                    print_r($penjualan_detail->getErrors());
                }
            } else if ($mode == 'update-permintaan') {
                $penjualan = Penjualan::model()->findByPk($penjualan_data['id_penjualan']);
                $penjualan->is_saved = 1;
                if ($penjualan->save()) {
                    Yii::app()->user->setFlash('success', 'Data Penjualan berhasil diupdate');
                } else {
                    print_r($penjualan->getErrors());
                }
                $this->redirect('update?id=' . $penjualan->id_penjualan);
            }
        }
        $data_proyek = Proyek::model()->findAll();
        $query_barang = "
            select b.* ,s.nama_satuan
            from barang b
            join satuan s on s.id_satuan=b.id_satuan
            order by b.nama_barang
            ";
        $data_barang = Yii::app()->db->createCommand($query_barang)->queryAll();
        $data_barang_detail = $this->getBarangDetail($penjualan_data['id_penjualan']);
        $data_supplier = Supplier::model()->findAll();
        $this->render('create', array(
            'penjualan' => $penjualan_data,
            'format_nomor_penjualan' => $format_nomor_penjualan,
            'data_barang_detail' => $data_barang_detail,
            'data_barang' => $data_barang,
            'data_supplier' => $data_supplier
        ));
    }

    public function actionUpdate() {
        $id_penjualan = Yii::app()->request->getParam('id');
        $penjualan = Penjualan::model()->findByPk($id_penjualan);
        if (!empty($_POST)) {
            $mode = Yii::app()->request->getPost('mode');
            if ($mode == 'tambah-barang') {
                $penjualan_detail = new PenjualanDetail;
                $penjualan_detail->id_penjualan = $penjualan['id_penjualan'];
                $penjualan_detail->id_barang_jadi = Yii::app()->request->getPost('barang');
                $penjualan_detail->jumlah_barang = Yii::app()->request->getPost('jumlah');
                $penjualan_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($penjualan_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dimasukkan');
                } else {
                    print_r($penjualan_detail->getErrors());
                }
            } else if ($mode == 'update-barang') {
                $id_pbd = Yii::app()->request->getPost('id_bd');
                $penjualan_detail = PenjualanDetail::model()->findByPk($id_pbd);
                if (Yii::app()->request->getPost('barang') == '') {
                    $penjualan_detail->id_barang_jadi = Yii::app()->request->getPost('id_barang');
                } else {
                    $penjualan_detail->id_barang_jadi = Yii::app()->request->getPost('barang');
                }
                $penjualan_detail->jumlah_barang = Yii::app()->request->getPost('jumlah');
                $penjualan_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($penjualan_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil diubah');
                } else {
                    print_r($penjualan_detail->getErrors());
                }
            } else if ($mode == 'hapus-barang') {
                $id_pbd = Yii::app()->request->getPost('id_bd');
                $penjualan_detail = PenjualanDetail::model()->findByPk($id_pbd);
                $penjualan_detail->is_deleted = 1;
                if ($penjualan_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dihapus');
                } else {
                    print_r($penjualan_detail->getErrors());
                }
            } else if ($mode == 'update-permintaan') {
                $penjualan = Penjualan::model()->findByPk($penjualan['id_penjualan']);
                $penjualan->is_saved = 1;
                if ($penjualan->save()) {
                    Yii::app()->user->setFlash('success', 'Data Penjualan berhasil diupdate');
                } else {
                    print_r($penjualan->getErrors());
                }
            }
        }
        $query_barang = "
            select b.* ,s.nama_satuan
            from barang_jadi b
            join satuan s on s.id_satuan=b.id_satuan
            order by b.nama_barang_jadi
            ";
        $data_barang = Yii::app()->db->createCommand($query_barang)->queryAll();
        $data_barang_detail = $this->getBarangDetail($penjualan['id_penjualan']);
        $data_supplier = Supplier::model()->findAll();
        $this->render('update', array(
            'id_penjualan' => $id_penjualan,
            'penjualan' => $penjualan,
            'data_barang_detail' => $data_barang_detail,
            'data_barang' => $data_barang,
            'data_supplier' => $data_supplier
        ));
    }

    public function actionSetujui() {
        $id_penjualan = Yii::app()->request->getParam('id');
        $penjualan = Penjualan::model()->findByPk($id_penjualan);
        if (!empty($_POST)) {
            if ($penjualan->id_peg_apv == '') {
                $penjualan->id_peg_apv = Yii::app()->user->id;
            } else {
                $penjualan->id_peg_apv = NULL;
            }
            if ($penjualan->save()) {
                Yii::app()->user->setFlash('success', 'Data Permintaan berhasil disetujui');
            } else {
                print_r($penjualan->getErrors());
            }
        }
        $data_proyek = Proyek::model()->findAll();
        $query_barang = "
            select b.* ,s.nama_satuan
            from barang b
            join satuan s on s.id_satuan=b.id_satuan
            order by b.nama_barang
            ";
        $data_barang = Yii::app()->db->createCommand($query_barang)->queryAll();
        $data_barang_detail = $this->getBarangDetail($penjualan['id_penjualan']);
        $data_supplier = Supplier::model()->findAll();
        $this->render('setujui', array(
            'id_penjualan' => $id_penjualan,
            'penjualan' => $penjualan,
            'data_barang_detail' => $data_barang_detail,
            'data_proyek' => $data_proyek,
            'data_barang' => $data_barang,
            'data_supplier' => $data_supplier
        ));
    }

    function getDateIndo($date) { // fungsi atau method untuk mengubah tanggal ke format indonesia
        // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
        $BulanIndo = array("Januari", "Februari", "Maret",
            "April", "Mei", "Juni",
            "Juli", "Agustus", "September",
            "Oktober", "November", "Desember");

        $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
        $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
        $tgl = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring

        $result = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
        return($result);
    }

    public function actionCetak() {
        $id_penjualan = Yii::app()->request->getParam('id');
        $query_view = "
		SELECT pb.* FROM penjualan pb where pb.id_penjualan='{$id_penjualan}' order BY pb.tgl_penjualan desc
            ";
        $data_view = Yii::app()->db->createCommand($query_view)->queryRow();

        // PRINT PDF
        $mpdf = Yii::app()->ePdf->mpdf();

        $mpdf->SetHTMLHeader('<div style="text-align: center; width:100%">{PAGENO}</div>');
        # render (full page)
        $mpdf->WriteHTML($this->renderPartial('cetak', array(
                    'penjualan' => $data_view,
                    'data_barang_detail' => $this->getBarangDetail($id_penjualan)
                        )
                        , true)
        );
        $mpdf->Output();
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = Penjualan::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->is_deleted = 1;
            $model->save();
            $this->redirect('read');
        }
    }

    public function actionUpdateBarangDetailAjax() {
        $id = Yii::app()->request->getQuery('id');
        $query_barang = "
            SELECT pbd.*,b.nama_barang_jadi,b.kode_barang_jadi,b.harga,b.deskripsi,s.nama_satuan
            FROM penjualan_detail pbd
            join barang_jadi b on b.id_barang_jadi=pbd.id_barang_jadi
            join satuan s on s.id_satuan=b.id_satuan
            where pbd.id_penjualan_detail='{$id}' 
            order by b.nama_barang_jadi
            ";
        $barang = Yii::app()->db->createCommand($query_barang)->queryRow();
        $this->renderPartial('updateBarangDetailAjax', array(
            'pb' => $barang,
        ));
    }

    public function actionSaveByField() {
        if (!empty($_POST)) {
            $coloumn = Yii::app()->request->getParam('name');
            $pk = Yii::app()->request->getParam('pk');
            $value = Yii::app()->request->getParam('value');
            Penjualan::model()->updateByPk($pk, array($coloumn => $value));
        }
    }

}
