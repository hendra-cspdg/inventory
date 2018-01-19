<?php

/**
 * This is the model class for table "tanda_terima_detail".
 *
 * The followings are the available columns in table 'tanda_terima_detail':
 * @property integer $id_tanda_terima_detail
 * @property integer $id_tanda_terima
 * @property integer $id_barang
 * @property integer $jumlah_barang
 * @property integer $jumlah_terima
 * @property string $harga_satuan
 * @property string $harga_terima
 * @property string $harga_total
 * @property string $keterangan
 * @property string $is_deleted
 */
class TandaTerimaDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tanda_terima_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tanda_terima, id_barang, jumlah_barang, jumlah_terima', 'numerical', 'integerOnly'=>true),
			array('harga_satuan, harga_terima, harga_total', 'length', 'max'=>20),
			array('keterangan', 'length', 'max'=>100),
			array('is_deleted', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_tanda_terima_detail, id_tanda_terima, id_barang, jumlah_barang, jumlah_terima, harga_satuan, harga_terima, harga_total, keterangan, is_deleted', 'safe', 'on'=>'search'),
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
			'id_tanda_terima_detail' => 'Id Tanda Terima Detail',
			'id_tanda_terima' => 'Id Tanda Terima',
			'id_barang' => 'Id Barang',
			'jumlah_barang' => 'Jumlah Barang',
			'jumlah_terima' => 'Jumlah Terima',
			'harga_satuan' => 'Harga Satuan',
			'harga_terima' => 'Harga Terima',
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

		$criteria->compare('id_tanda_terima_detail',$this->id_tanda_terima_detail);
		$criteria->compare('id_tanda_terima',$this->id_tanda_terima);
		$criteria->compare('id_barang',$this->id_barang);
		$criteria->compare('jumlah_barang',$this->jumlah_barang);
		$criteria->compare('jumlah_terima',$this->jumlah_terima);
		$criteria->compare('harga_satuan',$this->harga_satuan,true);
		$criteria->compare('harga_terima',$this->harga_terima,true);
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
	 * @return TandaTerimaDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
