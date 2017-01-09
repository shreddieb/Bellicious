<?php

class Mdlext_Mdloption_Model_Source_Styles {
	public function toOptionArray() {
		$options = array();
		$options[] = array('value'=>'no-repeat', 'label'=>'No Repeat');
		$options[] = array('value'=>'repeat', 'label'=>'Repeat');
		$options[] = array('value'=>'repeat-x', 'label'=>'Repeat X');
		$options[] = array('value'=>'repeat-y', 'label'=>'Repeat Y');
		return $options;
	}
}
?>