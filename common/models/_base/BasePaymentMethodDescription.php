<?php
/**
 * This is the model base class for the table "payment_method_description".
 * DO NOT MODIFY THIS FILE! It is automatically generated.
 * If any changes are necessary, you must set or override the required
 * property or method in class "PaymentMethodDescription".
 *
 * The followings are the available columns in table 'payment_method_description':
 * @property integer $payment_method_id
 * @property string $locale_code
 * @property string $name
 *
 * The followings are the available model relations:
 * @property PaymentMethod $paymentMethod
 */
abstract class BasePaymentMethodDescription extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PaymentMethodDescription the static model class
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
		return 'payment_method_description';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('payment_method_id, locale_code, name', 'required'),
			array('payment_method_id', 'numerical', 'integerOnly'=>true),
			array('locale_code', 'length', 'max'=>5),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('payment_method_id, locale_code, name', 'safe', 'on'=>'search'),
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
			'paymentMethod' => array(self::BELONGS_TO, 'PaymentMethod', 'payment_method_id'),
		);
	}

	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'payment_method_id' => Yii::t('label', 'Payment Method'),
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
		$criteria->compare('payment_method_id',$this->payment_method_id);
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