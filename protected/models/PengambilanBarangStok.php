<?php

/**
 * This is the model class for table "pengambilan_barang_stok".
 *
 * The followings are the available columns in table 'pengambilan_barang_stok':
 * @property integer $id_pengambilan_barang_stok
 * @property integer $id_pengambilan_barang_detail
 * @property integer $id_barang_stok
 * @property string $jumlah_ambil
 */
class PengambilanBarangStok extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pengambilan_barang_stok';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pengambilan_barang_detail, id_barang_stok', 'numerical', 'integerOnly'=>true),
			array('jumlah_ambil', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pengambilan_barang_stok, id_pengambilan_barang_detail, id_barang_stok, jumlah_ambil', 'safe', 'on'=>'search'),
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
			'id_pengambilan_barang_stok' => 'Id Pengambilan Barang Stok',
			'id_pengambilan_barang_detail' => 'Id Pengambilan Barang Detail',
			'id_barang_stok' => 'Id Barang Stok',
			'jumlah_ambil' => 'Jumlah Ambil',
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

		$criteria->compare('id_pengambilan_barang_stok',$this->id_pengambilan_barang_stok);
		$criteria->compare('id_pengambilan_barang_detail',$this->id_pengambilan_barang_detail);
		$criteria->compare('id_barang_stok',$this->id_barang_stok);
		$criteria->compare('jumlah_ambil',$this->jumlah_ambil,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PengambilanBarangStok the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
