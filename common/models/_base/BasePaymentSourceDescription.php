<?php
/**
 * This is the model base class for the table "payment_source_description".
 * DO NOT MODIFY THIS FILE! It is automatically generated.
 * If any changes are necessary, you must set or override the required
 * property or method in class "PaymentSourceDescription".
 *
 * The followings are the available columns in table 'payment_source_description':
 * @property string $id
 * @property string $locale_code
 * @property string $name
 * @property string $description
 * @property string $content
 *
 * The followings are the available model relations:
 * @property PaymentSource $id0
 */
abstract class BasePaymentSourceDescription extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PaymentSourceDescription the static model class
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
		return 'payment_source_description';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('locale_code, name, description, content', 'required'),
			array('locale_code', 'length', 'max'=>5),
			array('name, description', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, locale_code, name, description, content', 'safe', 'on'=>'search'),
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
			'id0' => array(self::BELONGS_TO, 'PaymentSource', 'id'),
		);
	}

	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label', 'ID'),
			'locale_code' => Yii::t('label', 'Locale Code'),
			'name' => Yii::t('label', 'Name'),
			'description' => Yii::t('label', 'Description'),
			'content' => Yii::t('label', 'Content'),
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
		$criteria->compare('id',$this->id,true);
		$criteria->compare('locale_code',$this->locale_code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content',$this->content,true);
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