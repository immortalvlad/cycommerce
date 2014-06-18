<?php
/**
 * This is the model base class for the table "order_status_description".
 * DO NOT MODIFY THIS FILE! It is automatically generated.
 * If any changes are necessary, you must set or override the required
 * property or method in class "OrderStatusDescription".
 *
 * The followings are the available columns in table 'order_status_description':
 * @property integer $order_status_id
 * @property string $locale_code
 * @property string $name
 *
 * The followings are the available model relations:
 * @property OrderStatus $orderStatus
 */
abstract class BaseOrderStatusDescription extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrderStatusDescription the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_status_description';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_status_id, locale_code, name', 'required'),
			array('order_status_id', 'numerical', 'integerOnly'=>true),
			array('locale_code', 'length', 'max'=>5),
			array('name', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('order_status_id, locale_code, name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.

		$localeCode = Yii::app()->getLanguage(); 

		return array(
			'orderStatus' => array(self::BELONGS_TO, 'OrderStatus', 'order_status_id'),
		);
	}

	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'order_status_id' => Yii::t('label', 'Order Status'),
			'locale_code' => Yii::t('label', 'Locale Code'),
			'name' => Yii::t('label', 'Name'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('order_status_id',$this->order_status_id);
		$criteria->compare('locale_code',$this->locale_code,true);
		$criteria->compare('name',$this->name,true);
		$dorder = '';
		if($this->hasAttribute('sort_order')){
			$dorder = 't.sort_order ASC';
		}
		else if($this->hasAttribute('id')){
			$dorder = 't.id DESC';
		}
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => array(
					'defaultOrder' => $dorder,
					'attributes' => array(			
							'*',
					),
			),		
        	'pagination'=>array(
				'pageSize'=>100,
			),
		));
	}
}