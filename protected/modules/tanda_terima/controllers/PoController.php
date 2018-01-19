<?php

class PoController extends Controller {

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
                    'view',
                    'create',
                    'update',
                    'delete',
                    'pilihPO',
                    'pilihBarangDetailAjax',
                    'updateBarangDetailAjax',
                    'saveByField'
                ),
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

    private function getBarangDetailPO($id) {
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

    private function getNoPo($id) {
        $query = "
            SELECT GROUP_CONCAT( DISTINCT nomor_po SEPARATOR  ', '  ) 
            FROM purchasing_order po
            join tanda_terima_po ttpo on ttpo.id_purchasing_order=po.id_purchasing_order
            WHERE ttpo.id_tanda_terima='{$id}'
            ";
        return Yii::app()->db->createCommand($query)->queryScalar();
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
            where tt.tgl_terima is not null and tt.is_saved=1 and tt.is_deleted=0  and tt.is_po='1'
            order BY tt.tgl_terima desc
            ";
        $data_view = Yii::app()->db->createCommand($query_view)->queryAll();
        foreach ($data_view as $d) {

            array_push($arr_data, array_merge($d, array('no_po' => $this->getNoPo($d['id_tanda_terima']), 'data_barang' => $this->getDetailBarang($d['id_tanda_terima']))));
        }
        $this->render('read', array(
            'data' => $arr_data
        ));
    }

    public function actionCreate() {
        $jumlah_data = TandaTerima::model()->countBySql("select count(*) from tanda_terima where is_saved=1 and is_po='1'") + 1;
        $format_nomor_ttm = str_pad($jumlah_data . 'PO', 10, "0", STR_PAD_LEFT);
        //cek data ada
        $tanda_terima_data = TandaTerima::model()->findByAttributes(array('kode_sistem' => $format_nomor_ttm));
        if (empty($tanda_terima_data)) {
            $tanda_terima_data = new TandaTerima;
            $tanda_terima_data->kode_sistem = $format_nomor_ttm;
            $tanda_terima_data->waktu_sistem = date('Y-m-d H:i:s');
            $tanda_terima_data->is_po = 1;
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
                if ($tanda_terima->tgl_terima > date('Y-m-d')) {
                    Yii::app()->user->setFlash('error', 'Tanda terima gagal dimasukkan. Tanggal terima tidak boleh melebihi tanggal sekarang');
                } else {
                    $tanda_terima->is_saved = 1;

                    if ($tanda_terima->save()) {
                        Yii::app()->user->setFlash('success', 'Data Tanda Terima berhasil dimasukkan');
                    } else {
                        print_r($tanda_terima->getErrors());
                    }
                }

                $this->redirect('update?id_tt=' . $tanda_terima->id_tanda_terima);
            } else if ($mode == 'pilih-po') {
                $id_po = Yii::app()->request->getPost('id_po');
                TandaTerimaPo::model()->deleteAllByAttributes(array('id_tanda_terima' => $tanda_terima_data['id_tanda_terima']));
                if (count($id_po) > 0) {
                    foreach ($id_po as $id) {
                        $tanda_terima_po = new TandaTerimaPo;
                        $tanda_terima_po->id_purchasing_order = $id;
                        $tanda_terima_po->id_tanda_terima = $tanda_terima_data['id_tanda_terima'];
                        $tanda_terima_po->save();
                    }
                }
            }
        }
        $data_barang_detail = $this->getDetailBarang($tanda_terima_data['id_tanda_terima']);
        $data_supplier = Supplier::model()->findAll();

        $this->render('create', array(
            'tanda_terima' => $tanda_terima_data,
            'nomor_po' => $this->getNoPo($tanda_terima_data['id_tanda_terima']),
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
                if ($tanda_terima->tgl_terima > date('Y-m-d')) {
                    Yii::app()->user->setFlash('error', 'Tanda terima gagal dimasukkan. Tanggal terima tidak boleh melebihi tanggal sekarang');
                } else {
                    $tanda_terima->is_saved = 1;

                    if ($tanda_terima->save()) {
                        Yii::app()->user->setFlash('success', 'Data Tanda Terima berhasil dimasukkan');
                    } else {
                        print_r($tanda_terima->getErrors());
                    }
                }
                $this->redirect('update?id_tt=' . $tanda_terima->id_tanda_terima);
            } else if ($mode == 'pilih-po') {
                $id_po = Yii::app()->request->getPost('id_po');
                TandaTerimaPo::model()->deleteAllByAttributes(array('id_tanda_terima' => $tanda_terima_data['id_tanda_terima']));
                if (count($id_po) > 0) {
                    foreach ($id_po as $id) {
                        $tanda_terima_po = new TandaTerimaPo;
                        $tanda_terima_po->id_purchasing_order = $id;
                        $tanda_terima_po->id_tanda_terima = $tanda_terima_data['id_tanda_terima'];
                        $tanda_terima_po->save();
                    }
                }
            }
        }
        $data_barang_detail = $this->getDetailBarang($tanda_terima_data['id_tanda_terima']);
        $data_supplier = Supplier::model()->findAll();

        $this->render('update', array(
            'tanda_terima' => $tanda_terima_data,
            'nomor_po' => $this->getNoPo($tanda_terima_data['id_tanda_terima']),
            'data_barang_detail' => $data_barang_detail,
            'data_supplier' => $data_supplier,
            'data_proyek' => Proyek::model()->findAll()
        ));
    }

    public function actionPilihPO() {
        $id_tt = Yii::app()->request->getParam('id_tt');
        $tanda_terima = TandaTerima::model()->findByPk($id_tt);
        $arr_data = array();
        $query = "
            select po.*,sp.nama_supplier,ttpo.id_tanda_terima_po
             from purchasing_order po
             join supplier sp on sp.id_supplier=po.id_supplier
             left join tanda_terima_po ttpo on ttpo.id_purchasing_order =po.id_purchasing_order and ttpo.id_tanda_terima='{$id_tt}'
             where po.is_saved='1' and po.is_deleted='0' and po.id_peg_pj!='' and id_peg_purchasing!='' and po.id_supplier='{$tanda_terima['id_supplier']}'
             order by po.id_purchasing_order desc
            ";
        $data = Yii::app()->db->createCommand($query)->queryAll();
        foreach ($data as $d) {
            array_push($arr_data, array_merge($d, array('nomor_fpb' => $this->getNoFPB($d['id_purchasing_order']), 'data_barang' => $this->getBarangDetailPO($d['id_purchasing_order']))));
        }
        $this->renderPartial('pilihPO', array(
            'tanda_terima' => $tanda_terima,
            'data_tt_po' => $arr_data,
        ));
    }

    public function actionPilihBarangDetailAjax() {
        $id = Yii::app()->request->getQuery('id');
        $tanda_terima = TandaTerima::model()->findByPk($id);
        $tanda_terima_po = TandaTerimaPo::model()->findAllByAttributes(array('id_tanda_terima' => $id));
        if (count($tanda_terima_po) > 0) {
            $query_barang = "
            SELECT pod.*,b.nama_barang,b.kode_barang,b.deskripsi,s.nama_satuan
            FROM purchasing_order_detail pod
            join purchasing_order po on pod.id_purchasing_order=po.id_purchasing_order
            join barang b on b.id_barang=pod.id_barang
            join satuan s on s.id_satuan=b.id_satuan
            where pod.id_purchasing_order in (select id_purchasing_order from tanda_terima_po where id_tanda_terima='{$tanda_terima['id_tanda_terima']}') and pod.is_deleted='0' and po.is_deleted='0'
            order by b.nama_barang
            ";
            $data_barang = Yii::app()->db->createCommand($query_barang)->queryAll();
            $this->renderPartial('pilihBarangDetailAjax', array(
                'tanda_terima' => $tanda_terima,
                'data_barang' => $data_barang,
            ));
        } else {
            Yii::app()->user->setFlash('error', 'Nomor PO belum di isi');
            $this->renderPartial('pilihBarangDetailAjax', array(
                'tanda_terima' => $tanda_terima,
                'data_barang' => array(),
            ));
        }
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
                    'no_fpb' => $this->getNoPo($data_view['id_tanda_terima']),
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
            if ($coloumn == 'nomor_po') {
                $value = implode(',', $value);
            }
            TandaTerima::model()->updateByPk($pk, array($coloumn => $value));
        }
    }

}
