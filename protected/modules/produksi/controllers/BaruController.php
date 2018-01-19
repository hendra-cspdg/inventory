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
        Yii::app()->db->createCommand("delete from produksi where is_saved=0 and is_deleted=0 and nomor_produksi is null")->query();
        Yii::app()->db->createCommand("delete from produksi_detail  where id_produksi not in (select id_produksi from produksi)")->query();
    }

    private function getBarangDetail($id) {
        $query_barang = "
            SELECT pd.*,b.nama_barang,b.kode_barang,b.deskripsi,s.nama_satuan
            FROM produksi_detail pd
            join barang b on b.id_barang=pd.id_barang
            join satuan s on s.id_satuan=b.id_satuan
            where pd.id_produksi='{$id}' and pd.is_delected='0'
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
            $model = Produksi::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->is_deleted = 1;
            $model->save();
        }
        $arr_data = array();
        $query_view = "
            SELECT
			p.*, bj.nama_barang_jadi, s.nama_satuan
			FROM produksi p left join barang_jadi bj
			on bj.id_barang_jadi=p.id_barang_jadi
			join satuan s
			on bj.id_satuan=s.id_satuan
			where p.is_saved=1 and p.is_deleted=0
			order BY p.tgl_produksi desc 
            ";
        $data_view = Yii::app()->db->createCommand($query_view)->queryAll();
        foreach ($data_view as $d) {
            array_push($arr_data, array_merge($d, array('data_barang' => $this->getBarangDetail($d['id_produksi']))));
        }
        $this->render('read', array(
            'data' => $arr_data
        ));
    }

    public function actionReadPersetujuan() {
        $this->clearGarbageData();
        $arr_data = array();
        $query_view = "
            SELECT
			p.*, bj.nama_barang_jadi
			FROM produksi p left join barang_jadi bj
			on bj.id_barang_jadi=p.id_barang_jadi
			where p.is_saved=1 and p.is_deleted=0
			order BY p.tgl_produksi desc 
            ";
        $data_view = Yii::app()->db->createCommand($query_view)->queryAll();
        foreach ($data_view as $d) {
            array_push($arr_data, array_merge($d, array('data_barang' => $this->getBarangDetail($d['id_produksi']))));
        }
        $this->render('readPersetujuan', array(
            'data' => $arr_data
        ));
    }

    public function actionCreate() {
	
        $jumlah_data = Produksi::model()->countBySql("select count(*) from produksi where is_saved = 1") + 1;
        $format_nomor_produksi = str_pad($jumlah_data, 10, "0", STR_PAD_LEFT);
        //cek data ada
        $produksi_barang_data = Produksi::model()->findByAttributes(array('kode_sistem' => $format_nomor_produksi));
        if (empty($produksi_barang_data)) {
            $produksi_barang_data = new Produksi;
            $produksi_barang_data->kode_sistem = $format_nomor_produksi;
            $produksi_barang_data->waktu_sistem = date('Y-m-d H:i:s');
            $produksi_barang_data->save();
        }

        if (!empty($_POST)) {
             $mode = Yii::app()->request->getPost('mode');
            if ($mode == 'tambah-barang') {
                $produksi_barang_detail = new ProduksiDetail;
                $produksi_barang_detail->id_produksi = $produksi_barang_data['id_produksi'];
                $produksi_barang_detail->id_barang = Yii::app()->request->getPost('barang');
                $produksi_barang_detail->jumlah_ambil = Yii::app()->request->getPost('jumlah');
                $produksi_barang_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($produksi_barang_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Produksi berhasil dimasukkan');
                } else {
                    print_r($produksi_barang_detail->getErrors());
                }
            } else if ($mode == 'update-barang') {
                $id_pd = Yii::app()->request->getPost('id_bd');
                $produksi_barang_detail = ProduksiBarangDetail::model()->findByPk($id_pd);
                if (Yii::app()->request->getPost('barang') == '') {
                    $produksi_barang_detail->id_barang = Yii::app()->request->getPost('id_barang');
                } else {
                    $produksi_barang_detail->id_barang = Yii::app()->request->getPost('barang');
                }
                $produksi_barang_detail->jumlah_ambil = Yii::app()->request->getPost('jumlah');
                $produksi_barang_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($produksi_barang_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil diubah');
                } else {
                    print_r($produksi_barang_detail->getErrors());
                }
            } else if ($mode == 'hapus-barang') {
                $id_pd = Yii::app()->request->getPost('id_bd');
                $produksi_barang_detail = ProduksiDetail::model()->findByPk($id_pd);
                $produksi_barang_detail->is_delected = 1;
                if ($produksi_barang_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Produksi berhasil dihapus');
                } else {
                    print_r($produksi_barang_detail->getErrors());
                }
            } else if ($mode == 'update-permintaan') {
                $produksi_barang = Produksi::model()->findByPk($produksi_barang_data['id_produksi']);
                $produksi_barang->is_saved = 1;
                if ($produksi_barang->save()) {
                    Yii::app()->user->setFlash('success', 'Data Produksi berhasil diupdate');
                } else {
                    print_r($produksi_barang->getErrors());
                }
                $this->redirect('update?id=' . $produksi_barang->id_produksi);
            }
        }
        $data_proyek = Proyek::model()->findAll();
        $query_barang = "
            select b.* ,s.nama_satuan, pbd.jumlah_ambil as jumlah_barang from barang b join pengambilan_barang_detail pbd on b.id_barang=pbd.id_barang join satuan s on s.id_satuan=b.id_satuan order by b.nama_barang 
            ";
        $data_barang = Yii::app()->db->createCommand($query_barang)->queryAll();
        $data_barang_detail = $this->getBarangDetail($produksi_barang_data['id_produksi']);
        $data_supplier = Supplier::model()->findAll();

        $this->render('create', array(
            'produksi' => $produksi_barang_data,
            'format_nomor_produksi' => $format_nomor_produksi,
            'data_proyek' => $data_proyek,
            'data_barang_detail' => $data_barang_detail,
            'data_proyek' => $data_proyek,
            'data_barang' => $data_barang,
            'data_supplier' => $data_supplier
        ));
    }

    public function actionUpdate() {
        $id_produksi = Yii::app()->request->getParam('id');
        $produksi_barang = Produksi::model()->findByPk($id_produksi);
        if (!empty($_POST)) {
            $mode = Yii::app()->request->getPost('mode');
            if ($mode == 'tambah-barang') {
                $produksi_barang_detail = new ProduksiDetail;
                $produksi_barang_detail->id_produksi = $produksi_barang['id_produksi'];
                $produksi_barang_detail->id_barang = Yii::app()->request->getPost('barang');
                $produksi_barang_detail->jumlah_ambil = Yii::app()->request->getPost('jumlah');
                $produksi_barang_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($produksi_barang_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Produksi berhasil dimasukkan');
                } else {
                    print_r($produksi_barang_detail->getErrors());
                }
            } else if ($mode == 'update-barang') {
                $id_pd = Yii::app()->request->getPost('id_bd');
                $produksi_barang_detail = ProduksiDetail::model()->findByPk($id_pd);
                if (Yii::app()->request->getPost('barang') == '') {
                    $produksi_barang_detail->id_barang = Yii::app()->request->getPost('id_barang');
                } else {
                    $produksi_barang_detail->id_barang = Yii::app()->request->getPost('barang');
                }
                $produksi_barang_detail->jumlah_ambil = Yii::app()->request->getPost('jumlah_ambil');
                $produksi_barang_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($produksi_barang_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil diubah');
                } else {
                    print_r($produksi_barang_detail->getErrors());
                }
            } else if ($mode == 'hapus-barang') {
                $id_pd = Yii::app()->request->getPost('id_bd');
                $produksi_barang_detail = ProduksiDetail::model()->findByPk($id_pd);
                $produksi_barang_detail->is_delected = 1;
                if ($produksi_barang_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Produksi berhasil dihapus');
                } else {
                    print_r($produksi_barang_detail->getErrors());
                }
            } else if ($mode == 'update-permintaan') {
                $produksi_barang = Produksi::model()->findByPk($produksi_barang['id_produksi']);
                $produksi_barang->is_saved = 1;
                if ($produksi_barang->save()) {
                    Yii::app()->user->setFlash('success', 'Data Produksi berhasil diupdate');
                } else {
                    print_r($produksi_barang->getErrors());
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
        $data_barang_detail = $this->getBarangDetail($produksi_barang['id_produksi']);
        $data_supplier = Supplier::model()->findAll();
        $this->render('update', array(
            'id_produksi' => $id_produksi,
            'produksi' => $produksi_barang,
            'data_barang_detail' => $data_barang_detail,
            'data_proyek' => $data_proyek,
            'data_barang' => $data_barang,
            'data_supplier' => $data_supplier
        ));
    }

    public function actionSetujui() {
        $id_produksi = Yii::app()->request->getParam('id');
        $produksi_barang = Produksi::model()->findByPk($id_produksi);
        if (!empty($_POST)) {
            if ($produksi_barang->id_peg_apv == '') {
                $produksi_barang->id_peg_apv = Yii::app()->user->id;
            } else {
                $produksi_barang->id_peg_apv = NULL;
            }
            if ($produksi_barang->save()) {
                Yii::app()->user->setFlash('success', 'Data Produksi berhasil disetujui');
            } else {
                print_r($produksi_barang->getErrors());
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
        $data_barang_detail = $this->getBarangDetail($produksi_barang['id_produksi']);
        $data_supplier = Supplier::model()->findAll();
        $this->render('setujui', array(
            'id_produksi' => $id_produksi,
            'produksi' => $produksi_barang,
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
        $id_produksi = Yii::app()->request->getParam('id');
        $query_view = "
            SELECT
			p.*, bj.nama_barang_jadi
			FROM produksi p left join barang_jadi bj
			on bj.id_barang_jadi=p.id_barang_jadi
			where p.is_saved=1 and p.is_deleted=0
			order BY p.tgl_produksi desc 
            ";
        $data_view = Yii::app()->db->createCommand($query_view)->queryRow();

        // PRINT PDF
        $mpdf = Yii::app()->ePdf->mpdf();

        $mpdf->SetHTMLHeader('<div style="text-align: center; width:100%">{PAGENO}</div>');
        # render (full page)
        $mpdf->WriteHTML($this->renderPartial('cetak', array(
                    'produksi' => $data_view,
                    'data_barang_detail' => $this->getBarangDetail($id_produksi)
                        )
                        , true)
        );
        $mpdf->Output();
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = Produksi::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->is_deleted = 1;
            $model->save();
            $this->redirect('read');
        }
    }

    public function actionUpdateBarangDetailAjax() {
        $id = Yii::app()->request->getQuery('id');
        $query_barang = "
            SELECT pbd.*,b.nama_barang,b.kode_barang,b.deskripsi,s.nama_satuan
            FROM produksi_detail pbd
            join barang b on b.id_barang=pbd.id_barang
            join satuan s on s.id_satuan=b.id_satuan
            where pbd.id_produksi_detail='{$id}' 
            order by b.nama_barang
            ";
        $barang = Yii::app()->db->createCommand($query_barang)->queryRow();
        
        $this->renderPartial('updateBarangDetailAjax', array(
            'pbd' => $barang,
        
        ));
    }

    public function actionSaveByField() {
        if (!empty($_POST)) {
            $coloumn = Yii::app()->request->getParam('name');
            $pk = Yii::app()->request->getParam('pk');
            $value = Yii::app()->request->getParam('value');
            Produksi::model()->updateByPk($pk, array($coloumn => $value));
        }
    }

}
