<?php
class Mdlext_Mdloption_Model_Source_Bgposition{
	public function toOptionArray() {
		$options = array();
		$options[] = array('value'=>'center center', 'label'=>'Center Center');
		$options[] = array('value'=>'left top', 'label'=>'Left Top');
		$options[] = array('value'=>'right top', 'label'=>'Right Top');
		$options[] = array('value'=>'left bottom', 'label'=>'Left Bottom');
		$options[] = array('value'=>'right bottom', 'label'=>'right Bottom');
		return $options;
	}
}
?>