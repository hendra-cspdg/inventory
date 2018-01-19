<?php

/**
 * This is the model class for table "permintaan_barang".
 *
 * The followings are the available columns in table 'permintaan_barang':
 * @property integer $id_permintaan_barang
 * @property string $kode_sistem
 * @property string $nomor_permintaan
 * @property integer $id_proyek
 * @property string $waktu_sistem
 * @property string $tgl_permintaan
 * @property string $tgl_on_site
 * @property string $status_kirim
 * @property integer $id_peg_apv
 * @property string $status_diterima
 * @property integer $id_peg_peminta
 * @property string $is_saved
 * @property string $is_deleted
 */
class PermintaanBarang extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'permintaan_barang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode_sistem, waktu_sistem', 'required'),
			array('id_proyek, id_peg_apv, id_peg_peminta', 'numerical', 'integerOnly'=>true),
			array('kode_sistem', 'length', 'max'=>10),
			array('nomor_permintaan', 'length', 'max'=>30),
			array('status_kirim, status_diterima, is_saved, is_deleted', 'length', 'max'=>2),
			array('tgl_permintaan, tgl_on_site', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_permintaan_barang, kode_sistem, nomor_permintaan, id_proyek, waktu_sistem, tgl_permintaan, tgl_on_site, status_kirim, id_peg_apv, status_diterima, id_peg_peminta, is_saved, is_deleted', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_permintaan_barang' => 'Id Permintaan Barang',
			'kode_sistem' => 'Kode Sistem',
			'id_permintaan' => 'Nomor Permintaan',
			'id_proyek' => 'Id Proyek',
			'waktu_sistem' => 'Waktu Sistem',
			'tgl_permintaan' => 'Tgl Permintaan',
			'tgl_on_site' => 'Tgl On Site',
			'status_kirim' => 'Status Kirim',
			'id_peg_apv' => 'Id Peg Apv',
			'status_diterima' => 'Status Diterima',
			'id_peg_peminta' => 'Id Peg Peminta',
			'is_saved' => 'Is Saved',
			'is_deleted' => 'Is Deleted',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_permintaan_barang',$this->id_permintaan_barang);
		$criteria->compare('kode_sistem',$this->kode_sistem,true);
		$criteria->compare('id_permintaan',$this->nomor_permintaan,true);
		$criteria->compare('id_proyek',$this->id_proyek);
		$criteria->compare('waktu_sistem',$this->waktu_sistem,true);
		$criteria->compare('tgl_permintaan',$this->tgl_permintaan,true);
		$criteria->compare('tgl_on_site',$this->tgl_on_site,true);
		$criteria->compare('status_kirim',$this->status_kirim,true);
		$criteria->compare('id_peg_apv',$this->id_peg_apv);
		$criteria->compare('status_diterima',$this->status_diterima,true);
		$criteria->compare('id_peg_peminta',$this->id_peg_peminta);
		$criteria->compare('is_saved',$this->is_saved,true);
		$criteria->compare('is_deleted',$this->is_deleted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PermintaanBarang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
