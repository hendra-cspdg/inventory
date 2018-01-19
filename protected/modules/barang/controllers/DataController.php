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
                'actions' => array('read', 'detail', 'cetak'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    private function getDataTransaksiBarang($id_barang, $tgl_awal, $tgl_akhir) {
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $q_tgl = "and tgl_transaksi between '{$tgl_awal}' and '{$tgl_akhir}'";
        } else {
            $q_tgl = '';
        }
        $query_transaksi = "
            select * from (
                (   select tt.tgl_terima tgl_transaksi,tt.nomor_ttm no_bukti,ttd.jumlah_terima jumlah,ttd.harga_terima as harga,ttd.keterangan, 1 status_transaksi
                    from tanda_terima tt 
                    join tanda_terima_detail ttd on ttd.id_tanda_terima=tt.id_tanda_terima
                    where ttd.id_barang='{$id_barang}' and ttd.is_deleted='0' and tt.is_deleted='0' and tt.is_saved='1'
                )
                union
                (   select p.tgl_produksi tgl_transaksi,p.nomor_produksi no_bukti,pd.jumlah_ambil jumlah,0 as harga,pd.keterangan,2 status_transaksi
                    from produksi p
                    join produksi_detail pd  on p.id_produksi=pd.id_produksi
                    where pd.id_barang='{$id_barang}' and p.id_peg_apv='1' and pd.is_delected='0' and p.is_deleted='0'  and p.is_saved='1'
                  )
            ) a
            where a.tgl_transaksi is not null
            order by a.tgl_transaksi asc
            ";
        $data_transaksi = Yii::app()->db->createCommand($query_transaksi)->queryAll();
        return $data_transaksi;
    }

    

    /**
     * Declares class-based actions.
     */
    public function actionRead() {
        $query_barang = "
            select b.id_barang,b.kode_barang,b.nama_barang,b.deskripsi,s.nama_satuan, ttd.total_terima, pd.total_ambil
            from barang b
            left join (
                select ttd.id_barang,tt.tgl_terima,sum(ttd.jumlah_terima) total_terima
                from tanda_terima_detail ttd
                join tanda_terima tt on tt.id_tanda_terima=ttd.id_tanda_terima
                where tt.is_deleted='0' and ttd.is_deleted='0'  and tt.is_saved='1'
                group by ttd.id_barang
            ) ttd on ttd.id_barang=b.id_barang
            left join (
                select pd.id_barang,p.tgl_produksi,sum(pd.jumlah_ambil) total_ambil
                from produksi_detail pd
                join produksi p on pd.id_produksi=p.id_produksi
                where p.is_deleted='0' and p.id_peg_apv='1' and pd.is_delected='0'  and p.is_saved='1'
                group by pd.id_barang
            ) pd on pd.id_barang=b.id_barang
            join satuan s on s.id_satuan = b.id_satuan
            where (ttd.total_terima!='' or pd.total_ambil!='')
            order by b.nama_barang
            ";
        $data_barang = Yii::app()->db->createCommand($query_barang)->queryAll();
        $this->render('read', array(
            'data_barang' => $data_barang,
            'tgl_awal' => Yii::app()->request->getParam('tgl_awal'),
            'tgl_akhir' => Yii::app()->request->getParam('tgl_akhir'),
        ));
    }

    public function actionDetail() {
        $id_barang = Yii::app()->request->getParam('id');
        $tgl_awal = Yii::app()->request->getParam('tgl_awal');
        $tgl_akhir = Yii::app()->request->getParam('tgl_akhir');
        $data_transaksi = $this->getDataTransaksiBarang($id_barang, $tgl_awal, $tgl_akhir);

        $query_barang = "
            select b.*,s.nama_satuan 
            from barang b
            join satuan s on s.id_satuan =s.id_satuan
            where id_barang='{$id_barang}'
            ";
        $barang = Yii::app()->db->createCommand($query_barang)->queryRow();

        $this->render('detail', array(
            'barang' => $barang,
            'id_barang' => $id_barang,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'stok' => Yii::app()->request->getParam('s'),
            'data_transaksi' => $data_transaksi,
        ));
    }

    public function actionCetak() {
        $id_barang = Yii::app()->request->getParam('id');
        $tgl_awal = Yii::app()->request->getParam('tgl_awal');
        $tgl_akhir = Yii::app()->request->getParam('tgl_akhir');
        $data_transaksi = $this->getDataTransaksiBarang($id_barang, $tgl_awal, $tgl_akhir);
        $query_barang = "
            select b.*,s.nama_satuan 
            from barang b
            join satuan s on s.id_satuan =s.id_satuan
            where id_barang='{$id_barang}'
            ";
        $barang = Yii::app()->db->createCommand($query_barang)->queryRow();
        // PRINT PDF
        $mpdf = Yii::app()->ePdf->mpdf();

        $mpdf->SetHTMLHeader('<div style="text-align: center; width:100%">{PAGENO}</div>');
        # render (full page)
        $mpdf->WriteHTML($this->renderPartial('cetak', array(
                    'barang' => $barang,
                    'id_barang' => $id_barang,
                    'stok' => Yii::app()->request->getParam('s'),
                    'tgl_awal' => $tgl_awal,
                    'tgl_akhir' => $tgl_akhir,
                    'data_transaksi' => $data_transaksi,
                        )
                        , true)
        );
        $mpdf->Output();
    }

}
