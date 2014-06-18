<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-ui.min.js',CClientScript::POS_HEAD)?><?php $this->widget('bootstrap.widgets.TbAlert'); ?><?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('category-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<p>
<?php echo Yii::t('info','You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.'); ?></p>

<?php echo TbHtml::linkButton(Yii::t('label','Advanced Search'), array('url' => '#', 'class' => 'search-button', 'color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
<div class="search-form hide">
<?php echo $this->renderPartial('_search', array('model'=>$model)); ?></div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'category-grid',
	'type'=>array(TbHtml::GRID_TYPE_STRIPED, TbHtml::GRID_TYPE_BORDERED, TbHtml::GRID_TYPE_CONDENSED),
	'dataProvider' => $model->search(),
	'filter' => $model,
	'rowCssClassExpression'=>'"items[]_{$data->id}"',
	'columns' => array(
		array(
			'class'=>'CCheckBoxColumn',
			'id' => 'check',
			'selectableRows' => 2,
		),
		array(
			'name'=>'name', 
			'header'=>Yii::t('label','Name'),
			'value'=>'$data->getName()', 
		),
		'id',
		array(
			'name'=>'store_id',
			'type' => 'raw',
			'value'=> '!empty($data->store) ? TbHtml::link(TbHtml::encode($data->store->name), array("store/view", "id" => $data->store_id)) : null',
		),
		array(
			'class' => 'yiiwheels.widgets.grid.WhImageColumn',
			'header'=>Yii::t('label','Image'),
			'imagePathExpression' => '!empty($data->images) ? TbHtml::encode(UtilityHelper::getPublishPath($data->images[0]->source)) : null',
			'htmlOptions' => array('class' => 'gridimage')
		),
		array(
			'name'=>'parent_id',
			'type'=>'raw',
			'value'=>'!empty($data->parent)? TbHtml::link(TbHtml::encode($data->parent->getName()), array("category/view", "id" => $data->parent_id)) : null',
			//'filter'=>CHtml::activeTextField($model,'parent_id'),
		),
		array(
			'name' => 'top',
			'value' => '($data->top === "0") ? \'No\' : \'Yes\'',
			'filter' => array('0' => 'No', '1' => 'Yes'),
		),
		'sort_order',
		array(
			'name' => 'status',
			'value' => '($data->status === "0") ? \'No\' : \'Yes\'',
			'filter' => array('0' => 'No', '1' => 'Yes'),
		),
		'date_added',
		'date_modified',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'htmlOptions'=>array('style'=>'width: 20px'),
			'buttons' => array(
				 'delete' => array(
				 'label' => Yii::t('label', 'Delete'), // text label of the button
				  'options' => array("class" => "dlink", 'title' => Yii::t('label', 'Delete')),
				  ),
				 'update' => array(
				 'label' => Yii::t('label', 'Update'), // text label of the button
				 'options' => array("class" => "update vlink", 'title' => Yii::t('label', 'Update')), 
					),
				 'view' => array(
				  'label' => Yii::t('label', 'View'), // text label of the button
				  'options' => array("class" => "view vlink", 'title' => Yii::t('label', 'View')), 
					)
				),
			'template' => '{view} {update} {delete}',
		),
	),
	'afterAjaxUpdate' => 'js:reSortGrid',
)); ?>
<div class="hlinks hide">
<div class="uid"></div>
<div class="sortLink"><?php echo $this->createUrl('sort'); ?></div>
</div>