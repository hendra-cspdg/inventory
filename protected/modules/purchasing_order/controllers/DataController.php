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
                'actions' => array(
                    'read',
                    'readPersetujuan',
                    'create',
                    'update',
                    'pilihFPB',
                    'setujui',
                    'updateBarangDetailAjax',
                    'pilihBarangDetailAjax',
                    'delete',
                    'saveByField',
                    'cetak'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    private function getBarangDetail($id) {
        $query_barang = "
            SELECT pod.*,b.nama_barang,b.kode_barang,b.deskripsi,s.nama_satuan
            FROM purchasing_order_detail pod
            join barang b on b.id_barang=pod.id_barang
            join satuan s on s.id_satuan=b.id_satuan
            where pod.id_purchasing_order='{$id}'  and pod.is_deleted='0'
            order by b.nama_barang
            ";
        return Yii::app()->db->createCommand($query_barang)->queryAll();
    }

    private function getBarangDetailFPB($id) {
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

    private function getNoFPB($id_po) {
        $query = "
            SELECT GROUP_CONCAT( DISTINCT pb.nomor_permintaan SEPARATOR  ', '  ) 
            FROM purchasing_order_fpb pofpb
            join permintaan_barang pb on pb.id_permintaan_barang=pofpb.id_permintaan_barang
            WHERE pofpb.id_purchasing_order ='{$id_po}'
            ";
        return Yii::app()->db->createCommand($query)->queryScalar();
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

    /**
     * Declares class-based actions.
     */
    public function actionRead() {
        if (!empty($_POST['id'])) {
            $model = PurchasingOrder::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->is_deleted = 1;
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Data PO berhasil dihapus');
            } else {
                print_r($model->getErrors());
            }
        }
        $arr_data = array();
        $query_purchasing_order = "
             select po.*,sp.nama_supplier
             from purchasing_order po
             join supplier sp on sp.id_supplier=po.id_supplier
             where po.is_saved='1' and po.is_deleted='0'
             order by po.id_purchasing_order desc
             ";
        $data_purchasing_order = Yii::app()->db->createCommand($query_purchasing_order)->queryAll();
        foreach ($data_purchasing_order as $d) {
            array_push($arr_data, array_merge($d, array('no_fpb' => $this->getNoFPB($d['id_purchasing_order']), 'data_barang' => $this->getBarangDetail($d['id_purchasing_order']))));
        }
        $this->render('read', array(
            'data' => $arr_data
        ));
    }

    public function actionReadPersetujuan() {
        $arr_data = array();
        $query_purchasing_order = "
             select po.*,sp.nama_supplier
             from purchasing_order po
             join supplier sp on sp.id_supplier=po.id_supplier
             where po.is_saved='1' and po.is_deleted='0'
             order by po.id_purchasing_order desc
             ";
        $data_purchasing_order = Yii::app()->db->createCommand($query_purchasing_order)->queryAll();
        foreach ($data_purchasing_order as $d) {
            array_push($arr_data, array_merge($d, array('no_fpb' => $this->getNoFPB($d['id_purchasing_order']), 'data_barang' => $this->getBarangDetail($d['id_purchasing_order']))));
        }
        $this->render('readPersetujuan', array(
            'data' => $arr_data
        ));
    }

    

    public function actionCreate() {
        $jumlah_data = PurchasingOrder::model()->countBySql("select count(*) from purchasing_order where is_saved=1") + 1;
        $format_nomor_permintaan = str_pad($jumlah_data, 10, "0", STR_PAD_LEFT);
        $format_nomor = str_pad($jumlah_data, 8, "PO00000", STR_PAD_LEFT);
        //cek data ada
        $purchasing_order_data = PurchasingOrder::model()->findByAttributes(array('kode_sistem' => $format_nomor_permintaan));
        if (empty($purchasing_order_data)) {
            $purchasing_order_data = new PurchasingOrder;
            $purchasing_order_data->kode_sistem = $format_nomor_permintaan;
            $purchasing_order_data->nomor_po = $format_nomor;
            $purchasing_order_data->waktu_sistem = date('Y-m-d H:i:s');
            $purchasing_order_data->save();
        }

        if (!empty($_POST)) {
            $mode = Yii::app()->request->getPost('mode');
            if ($mode == 'tambah-barang') {
                $purchasing_order_detail = new PurchasingOrderDetail;
                $purchasing_order_detail->id_purchasing_order = $purchasing_order_data['id_purchasing_order'];
                $purchasing_order_detail->id_barang = Yii::app()->request->getPost('barang');
                $purchasing_order_detail->jumlah_barang = Yii::app()->request->getPost('jumlah');
                $purchasing_order_detail->harga_satuan = Yii::app()->request->getPost('harga');
                $purchasing_order_detail->harga_total = Yii::app()->request->getPost('harga_total');
                $purchasing_order_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($purchasing_order_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dimasukkan');
                } else {
                    print_r($purchasing_order_detail->getErrors());
                }
            } else if ($mode == 'update-barang') {
                $id_pbd = Yii::app()->request->getPost('id_bd');
                $purchasing_order_detail = PurchasingOrderDetail::model()->findByPk($id_pbd);
                if (Yii::app()->request->getPost('barang') == '') {
                    $purchasing_order_detail->id_barang = Yii::app()->request->getPost('id_barang');
                } else {
                    $purchasing_order_detail->id_barang = Yii::app()->request->getPost('barang');
                }
                $purchasing_order_detail->jumlah_barang = Yii::app()->request->getPost('jumlah');
                $purchasing_order_detail->harga_satuan = Yii::app()->request->getPost('harga');
                $purchasing_order_detail->harga_total = Yii::app()->request->getPost('harga_total');
                $purchasing_order_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($purchasing_order_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil diubah');
                } else {
                    print_r($purchasing_order_detail->getErrors());
                }
            } else if ($mode == 'pilih-barang') {
                $arr_pbd = Yii::app()->request->getPost('id_pbd');
                if (count($arr_pbd) > 0) {
                    $indx = 0;
                    foreach ($arr_pbd as $idp) {
                        $pbd = PermintaanBarangDetail::model()->findByPk($idp);
                        $purchasing_order_detail = new PurchasingOrderDetail;
                        $purchasing_order_detail->id_purchasing_order = $purchasing_order_data['id_purchasing_order'];
                        $purchasing_order_detail->id_barang = $pbd->id_barang;
                        $purchasing_order_detail->jumlah_barang = Yii::app()->request->getPost('jumlah_' . $idp);
                        $purchasing_order_detail->harga_satuan = Yii::app()->request->getPost('harga_satuan_' . $idp);
                        $purchasing_order_detail->harga_total = Yii::app()->request->getPost('harga_total_' . $idp);
                        $purchasing_order_detail->keterangan = Yii::app()->request->getPost('keterangan_' . $idp);
                        $purchasing_order_detail->save();
                        $indx++;
                    }
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil tambah');
                }
            } else if ($mode == 'hapus-barang') {
                $id_pbd = Yii::app()->request->getPost('id_bd');
                $purchasing_order_detail = PurchasingOrderDetail::model()->findByPk($id_pbd);
                $purchasing_order_detail->is_deleted = 1;
                if ($purchasing_order_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dihapus');
                } else {
                    print_r($purchasing_order_detail->getErrors());
                }
            } else if ($mode == 'update-purchasing') {
                $purchasing_order = PurchasingOrder::model()->findByPk($purchasing_order_data['id_purchasing_order']);
                $purchasing_order->is_saved = 1;
                if ($purchasing_order->save()) {
                    Yii::app()->user->setFlash('success', 'Data Permintaan berhasil diupdate');
                } else {
                    print_r($purchasing_order->getErrors());
                }
                $this->redirect('update?id=' . $purchasing_order->id_purchasing_order);
            } else if ($mode == 'pilih-fpb') {
                $id_fpb = Yii::app()->request->getPost('id_fpb');
                PurchasingOrderFpb::model()->deleteAllByAttributes(array('id_purchasing_order' => $purchasing_order_data['id_purchasing_order']));
                if (count($id_fpb) > 0) {
                    foreach ($id_fpb as $id) {
                        $purchasing_order_fpb = new PurchasingOrderFpb;
                        $purchasing_order_fpb->id_permintaan_barang = $id;
                        $purchasing_order_fpb->id_purchasing_order = $purchasing_order_data['id_purchasing_order'];
                        $purchasing_order_fpb->save();
                    }
                }
            }
        }
        $data_barang_detail = $this->getBarangDetail($purchasing_order_data['id_purchasing_order']);
        $data_supplier = Supplier::model()->findAll();
        $query_nomor_permintaan = "select nomor_permintaan from permintaan_barang where is_saved='1' and is_deleted='0'";
        $data_nomor_permintaan = Yii::app()->db->createCommand($query_nomor_permintaan)->queryColumn();
        $this->render('create', array(
            'purchasing_order' => $purchasing_order_data,
            'nomor_pb' => $this->getNoFPB($purchasing_order_data['id_purchasing_order']),
            'data_nomor_permintaan' => $data_nomor_permintaan,
            'data_barang_detail' => $data_barang_detail,
            'data_supplier' => $data_supplier
        ));
    }

    public function actionUpdate() {
        $id = Yii::app()->request->getQuery('id');
        $purchasing_order = PurchasingOrder::model()->findByPk($id);

        if (!empty($_POST)) {
            $mode = Yii::app()->request->getPost('mode');
            if ($mode == 'tambah-barang') {
                $purchasing_order_detail = new PurchasingOrderDetail;
                $purchasing_order_detail->id_purchasing_order = $purchasing_order['id_purchasing_order'];
                $purchasing_order_detail->id_barang = Yii::app()->request->getPost('barang');
                $purchasing_order_detail->jumlah_barang = Yii::app()->request->getPost('jumlah');
                $purchasing_order_detail->harga_satuan = Yii::app()->request->getPost('harga');
                $purchasing_order_detail->harga_total = Yii::app()->request->getPost('harga_total');
                $purchasing_order_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($purchasing_order_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dimasukkan');
                } else {
                    print_r($purchasing_order_detail->getErrors());
                }
            } else if ($mode == 'update-barang') {
                $id_pbd = Yii::app()->request->getPost('id_bd');
                $purchasing_order_detail = PurchasingOrderDetail::model()->findByPk($id_pbd);
                if (Yii::app()->request->getPost('barang') == '') {
                    $purchasing_order_detail->id_barang = Yii::app()->request->getPost('id_barang');
                } else {
                    $purchasing_order_detail->id_barang = Yii::app()->request->getPost('barang');
                }
                $purchasing_order_detail->jumlah_barang = Yii::app()->request->getPost('jumlah');
                $purchasing_order_detail->harga_satuan = Yii::app()->request->getPost('harga');
                $purchasing_order_detail->harga_total = Yii::app()->request->getPost('harga_total');
                $purchasing_order_detail->keterangan = Yii::app()->request->getPost('keterangan');
                if ($purchasing_order_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil diubah');
                } else {
                    print_r($purchasing_order_detail->getErrors());
                }
            } else if ($mode == 'pilih-barang') {
                $arr_pbd = Yii::app()->request->getPost('id_pbd');
                if (count($arr_pbd) > 0) {
                    $indx = 0;
                    foreach ($arr_pbd as $idp) {
                        $pbd = PermintaanBarangDetail::model()->findByPk($idp);
                        $purchasing_order_detail = new PurchasingOrderDetail;
                        $purchasing_order_detail->id_purchasing_order = $purchasing_order['id_purchasing_order'];
                        $purchasing_order_detail->id_barang = $pbd->id_barang;
                        $purchasing_order_detail->jumlah_barang = Yii::app()->request->getPost('jumlah_' . $idp);
                        $purchasing_order_detail->harga_satuan = Yii::app()->request->getPost('harga_satuan_' . $idp);
                        $purchasing_order_detail->harga_total = Yii::app()->request->getPost('harga_total_' . $idp);
                        $purchasing_order_detail->keterangan = Yii::app()->request->getPost('keterangan_' . $idp);
                        $purchasing_order_detail->save();
                        $indx++;
                    }
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil tambah');
                }
            } else if ($mode == 'hapus-barang') {
                $id_pbd = Yii::app()->request->getPost('id_bd');
                $purchasing_order_detail = PurchasingOrderDetail::model()->findByPk($id_pbd);
                $purchasing_order_detail->is_deleted = 1;
                if ($purchasing_order_detail->save()) {
                    Yii::app()->user->setFlash('success', 'Data Barang berhasil dihapus');
                } else {
                    print_r($purchasing_order_detail->getErrors());
                }
            } else if ($mode == 'update-purchasing') {
                $purchasing_order = PurchasingOrder::model()->findByPk($purchasing_order['id_purchasing_order']);
                $purchasing_order->is_saved = 1;
                if ($purchasing_order->save()) {
                    Yii::app()->user->setFlash('success', 'Data Permintaan berhasil diupdate');
                } else {
                    print_r($purchasing_order->getErrors());
                }
            } else if ($mode == 'pilih-fpb') {
                $id_fpb = Yii::app()->request->getPost('id_fpb');
                PurchasingOrderFpb::model()->deleteAllByAttributes(array('id_purchasing_order' => $purchasing_order['id_purchasing_order']));
                if (count($id_fpb) > 0) {
                    foreach ($id_fpb as $id) {
                        $purchasing_order_fpb = new PurchasingOrderFpb;
                        $purchasing_order_fpb->id_permintaan_barang = $id;
                        $purchasing_order_fpb->id_purchasing_order = $purchasing_order['id_purchasing_order'];
                        $purchasing_order_fpb->save();
                    }
                }
            }
        }
        $data_barang_detail = $this->getBarangDetail($purchasing_order['id_purchasing_order']);
        $data_supplier = Supplier::model()->findAll();
        $query_nomor_permintaan = "select nomor_permintaan from permintaan_barang where is_saved='1' and is_deleted='0'";
        $data_nomor_permintaan = Yii::app()->db->createCommand($query_nomor_permintaan)->queryColumn();
        $this->render('update', array(
            'purchasing_order' => $purchasing_order,
            'nomor_pb' => $this->getNoFPB($purchasing_order['id_purchasing_order']),
            'data_nomor_permintaan' => $data_nomor_permintaan,
            'data_barang_detail' => $data_barang_detail,
            'data_supplier' => $data_supplier
        ));
    }
    
    public function actionPilihFPB() {
        $id_po = Yii::app()->request->getParam('id_po');
        $purchasing_order = PurchasingOrder::model()->findByPk($id_po);
        $arr_data = array();
        $query_fbp_po = "
            SELECT pb.*, p.nama_proyek,pofpb.id_purchasing_order_fpb
            FROM permintaan_barang pb
            left join proyek p on p.id_proyek=pb.id_proyek
            left join purchasing_order_fpb pofpb on pofpb.id_permintaan_barang = pb.id_permintaan_barang and pofpb.id_purchasing_order = '{$id_po}'
            where pb.is_saved=1 and pb.is_deleted=0 and pb.id_peg_apv!=''
            order BY pb.tgl_permintaan desc
            ";
        $data_fpb_po = Yii::app()->db->createCommand($query_fbp_po)->queryAll();
        foreach ($data_fpb_po as $d) {
            array_push($arr_data, array_merge($d, array('data_barang' => $this->getBarangDetailFPB($d['id_permintaan_barang']))));
        }
        $this->renderPartial('pilihFPB', array(
            'purchasing_order' => $purchasing_order,
            'data_po_fpb' => $arr_data,
        ));
    }

    public function actionSetujui() {
        $id = Yii::app()->request->getQuery('id');
        $purchasing_order = PurchasingOrder::model()->findByPk($id);

        if (!empty($_POST)) {
            $mode = Yii::app()->request->getPost('mode');
            if ($mode == 'setujui') {
                $purchasing_order = PurchasingOrder::model()->findByPk($purchasing_order['id_purchasing_order']);
                $purchasing_order->id_peg_pj = Yii::app()->request->getPost('id_peg_pj') != '' ? Yii::app()->user->id : NULL;
                $purchasing_order->id_peg_purchasing = Yii::app()->request->getPost('id_peg_purchasing') != '' ? Yii::app()->user->id : NULL;
                if ($purchasing_order->save()) {
                    Yii::app()->user->setFlash('success', 'Data Permintaan berhasil setujui');
                } else {
                    print_r($purchasing_order->getErrors());
                }
            }
        }
        $data_barang_detail = $this->getBarangDetail($purchasing_order['id_purchasing_order']);
        $data_supplier = Supplier::model()->findAll();
        $this->render('setujui', array(
            'purchasing_order' => $purchasing_order,
            'nomor_pb' => $this->getNoFPB($purchasing_order['id_purchasing_order']),
            'data_barang_detail' => $data_barang_detail,
            'data_supplier' => $data_supplier
        ));
    }

    public function actionPilihBarangDetailAjax() {
        $id = Yii::app()->request->getQuery('id');
        $purchasing_order = PurchasingOrder::model()->findByPk($id);
        $purchasing_order_fpb = PurchasingOrderFpb::model()->findAllByAttributes(array('id_purchasing_order' => $purchasing_order['id_purchasing_order']));
        if (count($purchasing_order_fpb)>0) {
            $query_barang = "
            SELECT pbd.*,b.nama_barang,b.kode_barang,b.deskripsi,s.nama_satuan
            FROM permintaan_barang_detail pbd
            join barang b on b.id_barang=pbd.id_barang
            join satuan s on s.id_satuan=b.id_satuan
            where pbd.id_permintaan_barang in (
                select id_permintaan_barang 
                from purchasing_order_fpb 
                where id_purchasing_order='{$purchasing_order['id_purchasing_order']}'
            ) and pbd.is_deleted='0'
            order by b.nama_barang
            ";
            $data_barang = Yii::app()->db->createCommand($query_barang)->queryAll();
            $this->renderPartial('pilihBarangDetailAjax', array(
                'purchasing_order' => $purchasing_order,
                'data_barang' => $data_barang,
            ));
        } else {
            Yii::app()->user->setFlash('error', 'Nomor Permintaan belum di isi');
            $this->renderPartial('pilihBarangDetailAjax', array(
                'purchasing_order' => $purchasing_order,
                'data_barang' => array(),
            ));
        }
    }

    public function actionUpdateBarangDetailAjax() {
        $id = Yii::app()->request->getQuery('id');
        $query_barang = "
            SELECT pod.*,b.nama_barang,b.kode_barang,b.deskripsi,s.nama_satuan
            FROM purchasing_order_detail pod
            join barang b on b.id_barang=pod.id_barang
            join satuan s on s.id_satuan=b.id_satuan
            where pod.id_purchasing_order_detail='{$id}' 
            order by b.nama_barang
            ";
        $barang = Yii::app()->db->createCommand($query_barang)->queryRow();
        $this->renderPartial('updateBarangDetailAjax', array(
            'pod' => $barang,
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
                    'no_fpb' => $this->getNoFPB($data_view['id_purchasing_order']),
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
            PurchasingOrder::model()->updateByPk($pk, array($coloumn => $value));
        }
    }

}
