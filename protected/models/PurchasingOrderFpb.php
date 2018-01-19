<?php

/**
 * This is the model class for table "purchasing_order_fpb".
 *
 * The followings are the available columns in table 'purchasing_order_fpb':
 * @property integer $id_purchasing_order_fpb
 * @property integer $id_purchasing_order
 * @property integer $id_permintaan_barang
 */
class PurchasingOrderFpb extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'purchasing_order_fpb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_purchasing_order, id_permintaan_barang', 'required'),
			array('id_purchasing_order, id_permintaan_barang', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_purchasing_order_fpb, id_purchasing_order, id_permintaan_barang', 'safe', 'on'=>'search'),
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
			'id_purchasing_order_fpb' => 'Id Purchasing Order Fpb',
			'id_purchasing_order' => 'Id Purchasing Order',
			'id_permintaan_barang' => 'Id Permintaan Barang',
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

		$criteria->compare('id_purchasing_order_fpb',$this->id_purchasing_order_fpb);
		$criteria->compare('id_purchasing_order',$this->id_purchasing_order);
		$criteria->compare('id_permintaan_barang',$this->id_permintaan_barang);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PurchasingOrderFpb the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
