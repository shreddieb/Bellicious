<?php
class Mdlb_Mlayer_Model_Source_Animationin{
	public function toOptionArray() {
		$options = array();
		$options[] = array('value'=>'bounceIn', 'label'=>'bounceIn');
		$options[] = array('value'=>'bounceInDown', 'label'=>'bounceInDown');
		$options[] = array('value'=>'bounceInLeft', 'label'=>'bounceInLeft');
		$options[] = array('value'=>'bounceInRight', 'label'=>'bounceInRight');
		$options[] = array('value'=>'bounceInUp', 'label'=>'bounceInUp');
		$options[] = array('value'=>'fadeIn', 'label'=>'fadeIn');
		$options[] = array('value'=>'fadeInDown', 'label'=>'fadeInDown');
		$options[] = array('value'=>'fadeInDownBig', 'label'=>'fadeInDownBig');
		$options[] = array('value'=>'fadeInLeft', 'label'=>'fadeInLeft');
		$options[] = array('value'=>'fadeInLeftBig', 'label'=>'fadeInLeftBig');
		$options[] = array('value'=>'fadeInRight', 'label'=>'fadeInRight');
		$options[] = array('value'=>'fadeInRightBig', 'label'=>'fadeInRightBig');
		$options[] = array('value'=>'fadeInUp', 'label'=>'fadeInUp');
		$options[] = array('value'=>'fadeInUpBig', 'label'=>'fadeInUpBig');
		$options[] = array('value'=>'flip', 'label'=>'flip');
		$options[] = array('value'=>'flipInX', 'label'=>'flipInX');
		$options[] = array('value'=>'flipInY', 'label'=>'flipInY');
		$options[] = array('value'=>'lightSpeedIn', 'label'=>'lightSpeedIn');
		$options[] = array('value'=>'rotateIn', 'label'=>'rotateIn');
		$options[] = array('value'=>'rotateInDownLeft', 'label'=>'rotateInDownLeft');
		$options[] = array('value'=>'rotateInDownRight', 'label'=>'rotateInDownRight');
		$options[] = array('value'=>'rotateInUpLeft', 'label'=>'rotateInUpLeft');
		$options[] = array('value'=>'rotateInUpRight', 'label'=>'rotateInUpRight');
		$options[] = array('value'=>'slideInUp', 'label'=>'slideInUp');
		$options[] = array('value'=>'slideInDown', 'label'=>'slideInDown');
		$options[] = array('value'=>'slideInLeft', 'label'=>'slideInLeft');
		$options[] = array('value'=>'slideInRight', 'label'=>'slideInRight');
		$options[] = array('value'=>'zoomIn', 'label'=>'zoomIn');
		$options[] = array('value'=>'zoomInDown', 'label'=>'zoomInDown');
		$options[] = array('value'=>'zoomInLeft', 'label'=>'zoomInLeft');
		$options[] = array('value'=>'zoomInRight', 'label'=>'zoomInRight');
		$options[] = array('value'=>'zoomInUp', 'label'=>'zoomInUp');
		$options[] = array('value'=>'rollIn', 'label'=>'rollIn');
		return $options;
	}
}