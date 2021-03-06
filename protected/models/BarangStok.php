<?php

/**
 * This is the model class for table "barang_stok".
 *
 * The followings are the available columns in table 'barang_stok':
 * @property integer $id_barang_stok
 * @property integer $id_tanda_terima
 * @property integer $id_barang
 * @property integer $jumlah_stok
 * @property string $harga_satuan
 */
class BarangStok extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'barang_stok';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tanda_terima, id_barang, jumlah_stok', 'numerical', 'integerOnly'=>true),
			array('harga_satuan', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_barang_stok, id_tanda_terima, id_barang, jumlah_stok, harga_satuan', 'safe', 'on'=>'search'),
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
			'id_barang_stok' => 'Id Barang Stok',
			'id_tanda_terima' => 'Id Tanda Terima',
			'id_barang' => 'Id Barang',
			'jumlah_stok' => 'Jumlah Stok',
			'harga_satuan' => 'Harga Satuan',
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

		$criteria->compare('id_barang_stok',$this->id_barang_stok);
		$criteria->compare('id_tanda_terima',$this->id_tanda_terima);
		$criteria->compare('id_barang',$this->id_barang);
		$criteria->compare('jumlah_stok',$this->jumlah_stok);
		$criteria->compare('harga_satuan',$this->harga_satuan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BarangStok the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
