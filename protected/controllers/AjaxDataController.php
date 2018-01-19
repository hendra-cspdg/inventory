<?php

class AjaxDataController extends Controller {

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
                'actions' => array('getJSONBarangProduksi', 'getJSONSupplier', 'getJSONProyek', 'getJSONBarangMentah', 'getJSONBarangJadi', 'getJSONBarang', 'getJSONBarangJadiCari', 'getJSONNomorPermintaan', 'getJSONNomorPO', 'getSatuanBarang', 'getSatuanBarangJadi'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionGetJSONSupplier() {
        header('Content-type: application/json');
        $query = "select id_supplier value,nama_supplier text from supplier";
        echo CJSON::encode(Yii::app()->db->createCommand($query)->queryAll());

        foreach (Yii::app()->log->routes as $route) {
            if ($route instanceof CWebLogRoute) {
                $route->enabled = false; // disable any weblogroutes
            }
        }
        Yii::app()->end();
    }

    public function actionGetJSONProyek() {
        header('Content-type: application/json');
        $query = "select id_proyek value,nama_proyek text from proyek";
        echo CJSON::encode(Yii::app()->db->createCommand($query)->queryAll());

        foreach (Yii::app()->log->routes as $route) {
            if ($route instanceof CWebLogRoute) {
                $route->enabled = false; // disable any weblogroutes
            }
        }
        Yii::app()->end();
    }
    public function actionGetJSONNomorPermintaan() {
        header('Content-type: application/json');
        $query = "select id_permintaan_barang value,nomor_permintaan text from permintaan_barang where is_saved='1' and is_deleted='0'";
        echo CJSON::encode(Yii::app()->db->createCommand($query)->queryAll());

        foreach (Yii::app()->log->routes as $route) {
            if ($route instanceof CWebLogRoute) {
                $route->enabled = false; // disable any weblogroutes
            }
        }
        Yii::app()->end();
    }
    
    public function actionGetJSONNomorPo() {
        header('Content-type: application/json');
        $query = "select id_purchasing_order value,nomor_po text from purchasing_order where is_saved='1' and is_deleted='0'";
        echo CJSON::encode(Yii::app()->db->createCommand($query)->queryAll());

        foreach (Yii::app()->log->routes as $route) {
            if ($route instanceof CWebLogRoute) {
                $route->enabled = false; // disable any weblogroutes
            }
        }
        Yii::app()->end();
    }

    public function actionGetJSONBarang() {
        $q_arr = explode(",", Yii::app()->request->getParam('q'));
        if(count($q_arr)>1){
            $q_nama = $q_arr[0];
            $q_deskripsi = $q_arr[1];
            $filter_nama = "and (upper(nama_barang) like upper('%{$q_nama}%')";
            $filter_deskripsi ="or upper(deskripsi) like upper('%{$q_deskripsi}%') )";
        }else{
            $q_nama = $q_arr[0];
            $q_deskripsi = '';
            $filter_nama = "and upper(nama_barang) like upper('%{$q_nama}%')";
            $filter_deskripsi ="";
        }
        header('Content-type: application/json');
        $arr_barang = array();
        $query = "
            select b.* ,s.nama_satuan
            from barang b
            join satuan s on s.id_satuan=b.id_satuan
            where b.nama_barang is not null  {$filter_nama} {$filter_deskripsi}
            order by b.nama_barang
            ";
        $data_barang = Yii::app()->db->createCommand($query)->queryAll();
        foreach ($data_barang as $d) {
            $deskripsi = json_decode($d['deskripsi']);
            if (count($deskripsi) > 0) {
                $des = implode(",", $deskripsi);
            } else {
                $des = $d['deskripsi'];
            }
            array_push($arr_barang, array(
                'id' => $d['id_barang'],
                'text' => '['.$d['kode_barang'].'] '.$d['nama_barang'] . ' ' . $des
                    )
            );
        }
        echo CJSON::encode($arr_barang);

        foreach (Yii::app()->log->routes as $route) {
            if ($route instanceof CWebLogRoute) {
                $route->enabled = false; // disable any weblogroutes
            }
        }
        Yii::app()->end();
    }
	
	 public function actionGetJSONBarangMentah() {
        $q_arr = explode(",", Yii::app()->request->getParam('q'));
        if(count($q_arr)>1){
            $q_nama = $q_arr[0];
            $q_deskripsi = $q_arr[1];
            $filter_nama = "and (upper(nama_barang) like upper('%{$q_nama}%')";
            $filter_deskripsi ="or upper(deskripsi) like upper('%{$q_deskripsi}%') )";
        }else{
            $q_nama = $q_arr[0];
            $q_deskripsi = '';
            $filter_nama = "and upper(nama_barang) like upper('%{$q_nama}%')";
            $filter_deskripsi ="";
        }
        header('Content-type: application/json');
        $arr_barang = array();
        $query = "
		select DISTINCT b.* ,s.nama_satuan, ttd.jumlah_terima
		from barang b join tanda_terima_detail ttd
		on ttd.id_barang=b.id_barang
		join satuan s
		on s.id_satuan=b.id_satuan
		where b.nama_barang is not null {$filter_nama} {$filter_deskripsi}
            order by b.nama_barang
            ";
        $data_barang = Yii::app()->db->createCommand($query)->queryAll();
        foreach ($data_barang as $d) {
            $deskripsi = json_decode($d['deskripsi']);
            if (count($deskripsi) > 0) {
                $des = implode(",", $deskripsi);
            } else {
                $des = $d['deskripsi'];
            }
            array_push($arr_barang, array(
                'id' => $d['id_barang'],
                'text' => '['.$d['kode_barang'].'] '.$d['nama_barang'] . ' ' . $des
                    )
            );
        }
        echo CJSON::encode($arr_barang);

        foreach (Yii::app()->log->routes as $route) {
            if ($route instanceof CWebLogRoute) {
                $route->enabled = false; // disable any weblogroutes
            }
        }
        Yii::app()->end();
    }
	
	public function actionGetJSONBarangJadi() {
        header('Content-type: application/json');
        $query = "select id_barang_jadi value,nama_barang_jadi text from barang_jadi";
        echo CJSON::encode(Yii::app()->db->createCommand($query)->queryAll());

        foreach (Yii::app()->log->routes as $route) {
            if ($route instanceof CWebLogRoute) {
                $route->enabled = false; // disable any weblogroutes
            }
        }
        Yii::app()->end();
    }
	
	public function actionGetJSONBarangJadiCari() {
        $q_arr = explode(",", Yii::app()->request->getParam('q'));
        if(count($q_arr)>1){
            $q_nama = $q_arr[0];
            $q_deskripsi = $q_arr[1];
            $filter_nama = "and (upper(nama_barang_jadi) like upper('%{$q_nama}%')";
            $filter_deskripsi ="or upper(deskripsi) like upper('%{$q_deskripsi}%') )";
        }else{
            $q_nama = $q_arr[0];
            $q_deskripsi = '';
            $filter_nama = "and upper(nama_barang_jadi) like upper('%{$q_nama}%')";
            $filter_deskripsi ="";
        }
        header('Content-type: application/json');
        $arr_barang = array();
        $query = "
            select b.* ,s.nama_satuan
            from barang_jadi b
            join satuan s on s.id_satuan=b.id_satuan
            where b.nama_barang_jadi is not null  {$filter_nama} {$filter_deskripsi}
            order by b.nama_barang_jadi
            ";
        $data_barang = Yii::app()->db->createCommand($query)->queryAll();
        foreach ($data_barang as $d) {
            $deskripsi = json_decode($d['deskripsi']);
            if (count($deskripsi) > 0) {
                $des = implode(",", $deskripsi);
            } else {
                $des = $d['deskripsi'];
            }
            array_push($arr_barang, array(
                'id' => $d['id_barang_jadi'],
                'text' => '['.$d['kode_barang_jadi'].'] '.$d['nama_barang_jadi'] . ' ' . $des
                    )
            );
        }
        echo CJSON::encode($arr_barang);

        foreach (Yii::app()->log->routes as $route) {
            if ($route instanceof CWebLogRoute) {
                $route->enabled = false; // disable any weblogroutes
            }
        }
        Yii::app()->end();
    }

	public function actionGetJSONBarangProduksi() {
        $q_arr = explode(",", Yii::app()->request->getParam('q'));
        if(count($q_arr)>1){
            $q_nama = $q_arr[0];
            $q_deskripsi = $q_arr[1];
            $filter_nama = "and (upper(nama_barang_jadi) like upper('%{$q_nama}%')";
            $filter_deskripsi ="or upper(deskripsi) like upper('%{$q_deskripsi}%') )";
        }else{
            $q_nama = $q_arr[0];
            $q_deskripsi = '';
            $filter_nama = "and upper(nama_barang_jadi) like upper('%{$q_nama}%')";
            $filter_deskripsi ="";
        }
        header('Content-type: application/json');
        $arr_barang = array();
        $query = "
			select distinct b.* ,s.nama_satuan
			from barang_jadi b
			join produksi p on b.id_barang_jadi=p.id_barang_jadi
			join satuan s on s.id_satuan=b.id_satuan
			where b.nama_barang_jadi is not null  {$filter_nama} {$filter_deskripsi}
            order by b.nama_barang_jadi
            ";
        $data_barang = Yii::app()->db->createCommand($query)->queryAll();
        foreach ($data_barang as $d) {
            $deskripsi = json_decode($d['deskripsi']);
            if (count($deskripsi) > 0) {
                $des = implode(",", $deskripsi);
            } else {
                $des = $d['deskripsi'];
            }
            array_push($arr_barang, array(
                'id' => $d['id_barang_jadi'],
                'text' => '['.$d['kode_barang_jadi'].'] '.$d['nama_barang_jadi'] . ' ' . $des
                    )
            );
        }
        echo CJSON::encode($arr_barang);

        foreach (Yii::app()->log->routes as $route) {
            if ($route instanceof CWebLogRoute) {
                $route->enabled = false; // disable any weblogroutes
            }
        }
        Yii::app()->end();
    }

	
    public function actionGetSatuanBarang() {
        $id = Yii::app()->request->getParam('id');
        $query = "select nama_satuan from satuan where id_satuan in (select id_satuan from barang where id_barang='{$id}')";
        echo Yii::app()->db->createCommand($query)->queryScalar();
        Yii::app()->end();
    }

    public function actionGetSatuanBarangJadi() {
        $id = Yii::app()->request->getParam('id');
        $query = "select nama_satuan from satuan where id_satuan in (select id_satuan from barang_jadi where id_barang_jadi='{$id}')";
        echo Yii::app()->db->createCommand($query)->queryScalar();
        Yii::app()->end();
    }

}
