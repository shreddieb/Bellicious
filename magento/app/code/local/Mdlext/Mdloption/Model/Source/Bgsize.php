<?php
class Mdlext_Mdloption_Model_Source_Bgsize{
	public function toOptionArray() {
		$options = array();
		$options[] = array('value'=>'none', 'label'=>'None');
		$options[] = array('value'=>'100%', 'label'=>'100%');
		$options[] = array('value'=>'cover', 'label'=>'Cover');
		return $options;
	}
}

?>