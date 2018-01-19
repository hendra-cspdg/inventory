<?php

/**
 * This is the model class for table "purchasing_order".
 *
 * The followings are the available columns in table 'purchasing_order':
 * @property integer $id_purchasing_order
 * @property string $kode_sistem
 * @property integer $id_supplier
 * @property string $nomor_po
 * @property string $syarat_pembayaran
 * @property string $waktu_sistem
 * @property string $tgl_on_site
 * @property string $jadwal_nota
 * @property string $alamat_pengiriman
 * @property integer $id_peg_purchasing
 * @property integer $id_peg_pj
 * @property string $is_saved
 * @property string $is_deleted
 */
class PurchasingOrder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'purchasing_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('waktu_sistem', 'required'),
			array('id_supplier, id_peg_purchasing, id_peg_pj', 'numerical', 'integerOnly'=>true),
			array('kode_sistem', 'length', 'max'=>10),
			array('nomor_po', 'length', 'max'=>30),
			array('syarat_pembayaran, jadwal_nota', 'length', 'max'=>50),
			array('alamat_pengiriman', 'length', 'max'=>1000),
			array('is_saved, is_deleted', 'length', 'max'=>2),
			array('tgl_on_site', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_purchasing_order, kode_sistem, id_supplier, nomor_po, syarat_pembayaran, waktu_sistem, tgl_on_site, jadwal_nota, alamat_pengiriman, id_peg_purchasing, id_peg_pj, is_saved, is_deleted', 'safe', 'on'=>'search'),
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
			'id_purchasing_order' => 'Id Purchasing Order',
			'kode_sistem' => 'Kode Sistem',
			'id_supplier' => 'Id Supplier',
			'nomor_po' => 'Nomor Po',
			'syarat_pembayaran' => 'Syarat Pembayaran',
			'waktu_sistem' => 'Waktu Sistem',
			'tgl_on_site' => 'Tgl On Site',
			'jadwal_nota' => 'Jadwal Nota',
			'alamat_pengiriman' => 'Alamat Pengiriman',
			'id_peg_purchasing' => 'Id Peg Purchasing',
			'id_peg_pj' => 'Id Peg Pj',
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

		$criteria->compare('id_purchasing_order',$this->id_purchasing_order);
		$criteria->compare('kode_sistem',$this->kode_sistem,true);
		$criteria->compare('id_supplier',$this->id_supplier);
		$criteria->compare('nomor_po',$this->nomor_po,true);
		$criteria->compare('syarat_pembayaran',$this->syarat_pembayaran,true);
		$criteria->compare('waktu_sistem',$this->waktu_sistem,true);
		$criteria->compare('tgl_on_site',$this->tgl_on_site,true);
		$criteria->compare('jadwal_nota',$this->jadwal_nota,true);
		$criteria->compare('alamat_pengiriman',$this->alamat_pengiriman,true);
		$criteria->compare('id_peg_purchasing',$this->id_peg_purchasing);
		$criteria->compare('id_peg_pj',$this->id_peg_pj);
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
	 * @return PurchasingOrder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
