<?php

class BaruController extends Controller {

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
        Yii::app()->db->createCommand("delete from permintaan_barang  where is_saved=0 and is_deleted=0 and nomor_permintaan is null")->query();
        Yii::app()->db->createCommand("delete from permintaan_barang_detail  where id_permintaan_barang not in (select id_permintaan_barang from permintaan_barang)")->query();
    }

    private function getBarangDetail($id) {
        $query_barang = "
            SELECT pbd.*,b.nama_barang,b.kode_barang,b.deskripsi,s.nama_satuan
            FROM permintaan_barang_detail pbd
            join barang b on b.id_barang=pbd.id_barang
            join satuan s on s.id_satuan=b.id_satuan
            where pbd.id_permintaan_barang='{$id}'  and pbd.is_deleted='0'
            order by b.nama_barang
            ";
        return Yii::app()->db->createCommand($query_barang)->queryAll();
    }

    /**
     * Declares class-based actions.
     */
    public function actionRead() {
        $this->clearGarbageData();
        if (!empty($_POST['id'])) {
            $model = PermintaanBarang::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->is_deleted = 1;
            $model->save();
        }
        $arr_data = array();
        $query_view = "
            SELECT pb.*, p.nama_proyek
            FROM permintaan_barang pb
            left join proyek p on p.id_proyek=pb.id_proyek
            where pb.is_saved=1 and pb.is_deleted=0
            order BY pb.tgl_permintaan desc
            ";
        $data_view = Yii::app()->db->createCommand($query_view)->queryAll();
        foreach ($data_view as $d) {
            array_push($arr_data, array_merge($d, array('data_barang' => $this->getBarangDetail($d['id_permintaan_barang']))));
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
            FROM permintaan_barang pb
            left join proyek p on p.id_proyek=pb.id_proyek
            where pb.is_saved=1 and pb.is_deleted=0
            order BY pb.tgl_permintaan desc
            ";
        $data_view = Yii::app()->db->createCommand($query_view)->queryAll();
        foreach ($data_view as $d) {
            array_push($arr_data, array_merge($d, array('data_barang' => $this->getBarangDetail($d['id_permintaan_barang']))));
        }
        $this->render('readPersetujuan', array(
            'data' => $arr_data
        ));
    }

    public function actionCreate() {
	
        $jumlah_data = PermintaanBarang::model()->countBySql("select count(*) from permintaan_barang where is_saved = 1") + 1;
        $format_nomor_permintaan = str_pad($jumlah_data, 10, "0", STR_PAD_LEFT);
        $format_nomor = str_pad($jumlah_data, 8, "FPB0000", STR_PAD_LEFT);
        //cek data ada
        $permintaan_barang_data = PermintaanBarang::model()->findByAttributes(array('kode_sistem' => $format_nomor_permintaan));
        if (empty($permintaan_barang_data)) {
            $permintaan_barang_data = new PermintaanBarang;
            $permintaan_barang_data->kode_sistem = $format_nomor_permintaan;
            $permintaan_barang_data->waktu_sistem = date('Y-m-d H:i:s');
            $permintaan_barang_data->save();
        }

        if (!empty($_POST)) {
             $mode = Yii::app()->request->getPost('mode');
            if ($mode == 'tambah-barang') {
                $permintaan_barang_detail = new PermintaanBarangDetail;
                $permintaan_barang_detail->id_permintaan_barang = $permintaan_barang_data['id_permintaan_barang'];
                $permintaan_barang_detail->id_barang = Yii::app()->request->getPost('barang');
                $permintaan_barang_detail->jumlah_barang = Yii::app()->request->getPost('jumlah');
                $permintaan_barang_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($permintaan_barang_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dimasukkan');
                } else {
                    print_r($permintaan_barang_detail->getErrors());
                }
            } else if ($mode == 'update-barang') {
                $id_pbd = Yii::app()->request->getPost('id_bd');
                $permintaan_barang_detail = PermintaanBarangDetail::model()->findByPk($id_pbd);
                if (Yii::app()->request->getPost('barang') == '') {
                    $permintaan_barang_detail->id_barang = Yii::app()->request->getPost('id_barang');
                } else {
                    $permintaan_barang_detail->id_barang = Yii::app()->request->getPost('barang');
                }
                $permintaan_barang_detail->jumlah_barang = Yii::app()->request->getPost('jumlah');
                $permintaan_barang_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($permintaan_barang_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil diubah');
                } else {
                    print_r($permintaan_barang_detail->getErrors());
                }
            } else if ($mode == 'hapus-barang') {
                $id_pbd = Yii::app()->request->getPost('id_bd');
                $permintaan_barang_detail = PermintaanBarangDetail::model()->findByPk($id_pbd);
                $permintaan_barang_detail->is_deleted = 1;
                if ($permintaan_barang_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dihapus');
                } else {
                    print_r($permintaan_barang_detail->getErrors());
                }
            } else if ($mode == 'update-permintaan') {
                $permintaan_barang = PermintaanBarang::model()->findByPk($permintaan_barang_data['id_permintaan_barang']);
                $permintaan_barang->is_saved = 1;
                $permintaan_barang->nomor_permintaan = $format_nomor;
                if ($permintaan_barang->save()) {
                    Yii::app()->user->setFlash('success', 'Data Permintaan berhasil diupdate');
                } else {
                    print_r($permintaan_barang->getErrors());
                }
                $this->redirect('update?id=' . $permintaan_barang->id_permintaan_barang);
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
        $data_barang_detail = $this->getBarangDetail($permintaan_barang_data['id_permintaan_barang']);
        $data_supplier = Supplier::model()->findAll();

        $this->render('create', array(
            'permintaan_barang' => $permintaan_barang_data,
            'format_nomor_permintaan' => $format_nomor_permintaan,
            'data_proyek' => $data_proyek,
            'data_barang_detail' => $data_barang_detail,
            'data_proyek' => $data_proyek,
            'data_barang' => $data_barang,
            'data_supplier' => $data_supplier
        ));
    }

    public function actionUpdate() {
        $id_permintaan = Yii::app()->request->getParam('id');
        $permintaan_barang = PermintaanBarang::model()->findByPk($id_permintaan);
        if (!empty($_POST)) {
            $mode = Yii::app()->request->getPost('mode');
            if ($mode == 'tambah-barang') {
                $permintaan_barang_detail = new PermintaanBarangDetail;
                $permintaan_barang_detail->id_permintaan_barang = $permintaan_barang['id_permintaan_barang'];
                $permintaan_barang_detail->id_barang = Yii::app()->request->getPost('barang');
                $permintaan_barang_detail->jumlah_barang = Yii::app()->request->getPost('jumlah');
                $permintaan_barang_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($permintaan_barang_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dimasukkan');
                } else {
                    print_r($permintaan_barang_detail->getErrors());
                }
            } else if ($mode == 'update-barang') {
                $id_pbd = Yii::app()->request->getPost('id_bd');
                $permintaan_barang_detail = PermintaanBarangDetail::model()->findByPk($id_pbd);
                if (Yii::app()->request->getPost('barang') == '') {
                    $permintaan_barang_detail->id_barang = Yii::app()->request->getPost('id_barang');
                } else {
                    $permintaan_barang_detail->id_barang = Yii::app()->request->getPost('barang');
                }
                $permintaan_barang_detail->jumlah_barang = Yii::app()->request->getPost('jumlah');
                $permintaan_barang_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($permintaan_barang_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil diubah');
                } else {
                    print_r($permintaan_barang_detail->getErrors());
                }
            } else if ($mode == 'hapus-barang') {
                $id_pbd = Yii::app()->request->getPost('id_bd');
                $permintaan_barang_detail = PermintaanBarangDetail::model()->findByPk($id_pbd);
                $permintaan_barang_detail->is_deleted = 1;
                if ($permintaan_barang_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dihapus');
                } else {
                    print_r($permintaan_barang_detail->getErrors());
                }
            } else if ($mode == 'update-permintaan') {
                $permintaan_barang = PermintaanBarang::model()->findByPk($permintaan_barang['id_permintaan_barang']);
                $permintaan_barang->is_saved = 1;
                if ($permintaan_barang->save()) {
                    Yii::app()->user->setFlash('success', 'Data Permintaan berhasil diupdate');
                } else {
                    print_r($permintaan_barang->getErrors());
                }
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
        $data_barang_detail = $this->getBarangDetail($permintaan_barang['id_permintaan_barang']);
        $data_supplier = Supplier::model()->findAll();
        $this->render('update', array(
            'id_permintaan' => $id_permintaan,
            'permintaan_barang' => $permintaan_barang,
            'data_barang_detail' => $data_barang_detail,
            'data_proyek' => $data_proyek,
            'data_barang' => $data_barang,
            'data_supplier' => $data_supplier
        ));
    }

    public function actionSetujui() {
        $id_permintaan = Yii::app()->request->getParam('id');
        $permintaan_barang = PermintaanBarang::model()->findByPk($id_permintaan);
        if (!empty($_POST)) {
            if ($permintaan_barang->id_peg_apv == '') {
                $permintaan_barang->id_peg_apv = Yii::app()->user->id;
            } else {
                $permintaan_barang->id_peg_apv = NULL;
            }
            if ($permintaan_barang->save()) {
                Yii::app()->user->setFlash('success', 'Data Permintaan berhasil disetujui');
            } else {
                print_r($permintaan_barang->getErrors());
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
        $data_barang_detail = $this->getBarangDetail($permintaan_barang['id_permintaan_barang']);
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
        $id_permintaan = Yii::app()->request->getParam('id');
        $query_view = "
            SELECT pb.*, p.nama_proyek,p.alamat_proyek
            FROM permintaan_barang pb
            left join proyek p on p.id_proyek=pb.id_proyek
            where pb.id_permintaan_barang='{$id_permintaan}'
            order BY pb.tgl_permintaan desc
            ";
        $data_view = Yii::app()->db->createCommand($query_view)->queryRow();
        // echo var_dump($data_view); die();
        // PRINT PDF
        $mpdf = Yii::app()->ePdf->mpdf();
        // echo var_dump($mpdf); die();
        
        $mpdf->SetHTMLHeader('<div style="text-align: center; width:100%">{PAGENO}</div>');
        # render (full page)
        $mpdf->WriteHTML($this->renderPartial('cetak', array(
                    'permintaan_barang' => $data_view,
                    'data_barang_detail' => $this->getBarangDetail($id_permintaan)
                        )
                        , true)
        );
        $mpdf->Output();
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = PermintaanBarang::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->is_deleted = 1;
            $model->save();
            $this->redirect('read');
        }
    }

    public function actionUpdateBarangDetailAjax() {
        $id = Yii::app()->request->getQuery('id');
        $query_barang = "
            SELECT pbd.*,b.nama_barang,b.kode_barang,b.deskripsi,s.nama_satuan
            FROM permintaan_barang_detail pbd
            join barang b on b.id_barang=pbd.id_barang
            join satuan s on s.id_satuan=b.id_satuan
            where pbd.id_permintaan_barang_detail='{$id}' 
            order by b.nama_barang
            ";
        $barang = Yii::app()->db->createCommand($query_barang)->queryRow();
        $data_supplier = Supplier::model()->findAll();
        $this->renderPartial('updateBarangDetailAjax', array(
            'pbd' => $barang,
            'data_supplier' => $data_supplier,
        ));
    }

    public function actionSaveByField() {
        if (!empty($_POST)) {
            $coloumn = Yii::app()->request->getParam('name');
            $pk = Yii::app()->request->getParam('pk');
            $value = Yii::app()->request->getParam('value');
            PermintaanBarang::model()->updateByPk($pk, array($coloumn => $value));
        }
    }

}
