<?php

/**
 * This is the model class for table "purchasing_order_detail".
 *
 * The followings are the available columns in table 'purchasing_order_detail':
 * @property integer $id_purchasing_order_detail
 * @property integer $id_purchasing_order
 * @property integer $id_barang
 * @property string $jumlah_barang
 * @property string $harga_satuan
 * @property string $harga_total
 * @property string $keterangan
 * @property string $is_deleted
 */
class PurchasingOrderDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'purchasing_order_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('is_deleted', 'required'),
			array('id_purchasing_order, id_barang', 'numerical', 'integerOnly'=>true),
			array('jumlah_barang, harga_satuan, harga_total', 'length', 'max'=>20),
			array('keterangan', 'length', 'max'=>100),
			array('is_deleted', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_purchasing_order_detail, id_purchasing_order, id_barang, jumlah_barang, harga_satuan, harga_total, keterangan, is_deleted', 'safe', 'on'=>'search'),
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
			'id_purchasing_order_detail' => 'Id Purchasing Order Detail',
			'id_purchasing_order' => 'Id Purchasing Order',
			'id_barang' => 'Id Barang',
			'jumlah_barang' => 'Jumlah Barang',
			'harga_satuan' => 'Harga Satuan',
			'harga_total' => 'Harga Total',
			'keterangan' => 'Keterangan',
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

		$criteria->compare('id_purchasing_order_detail',$this->id_purchasing_order_detail);
		$criteria->compare('id_purchasing_order',$this->id_purchasing_order);
		$criteria->compare('id_barang',$this->id_barang);
		$criteria->compare('jumlah_barang',$this->jumlah_barang,true);
		$criteria->compare('harga_satuan',$this->harga_satuan,true);
		$criteria->compare('harga_total',$this->harga_total,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('is_deleted',$this->is_deleted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PurchasingOrderDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
