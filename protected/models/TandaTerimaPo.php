<?php

/**
 * This is the model class for table "tanda_terima_po".
 *
 * The followings are the available columns in table 'tanda_terima_po':
 * @property integer $id_tanda_terima_po
 * @property integer $id_tanda_terima
 * @property integer $id_purchasing_order
 */
class TandaTerimaPo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tanda_terima_po';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tanda_terima, id_purchasing_order', 'required'),
			array('id_tanda_terima, id_purchasing_order', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_tanda_terima_po, id_tanda_terima, id_purchasing_order', 'safe', 'on'=>'search'),
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
			'id_tanda_terima_po' => 'Id Tanda Terima Po',
			'id_tanda_terima' => 'Id Tanda Terima',
			'id_purchasing_order' => 'Id Purchasing Order',
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

		$criteria->compare('id_tanda_terima_po',$this->id_tanda_terima_po);
		$criteria->compare('id_tanda_terima',$this->id_tanda_terima);
		$criteria->compare('id_purchasing_order',$this->id_purchasing_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TandaTerimaPo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
