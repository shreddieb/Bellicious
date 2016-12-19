<?php
class Mdlext_Mdloption_Model_Source_Bgattachment{
	public function toOptionArray() {
		$options = array();
		$options[] = array('value'=>'scroll', 'label'=>'Scroll');
		$options[] = array('value'=>'fixed', 'label'=>'Fixed');
		return $options;
	}
}

?>