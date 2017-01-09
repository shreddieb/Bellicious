<?php
class Mdlb_Mlayer_Model_Source_Animationout{
	public function toOptionArray() {
		$options = array();
		$options[] = array('value'=>'bounceOut', 'label'=>'bounceOut');
		$options[] = array('value'=>'bounceOutDown', 'label'=>'bounceOutDown');
		$options[] = array('value'=>'bounceOutLeft', 'label'=>'bounceOutLeft');
		$options[] = array('value'=>'bounceOutRight', 'label'=>'bounceOutRight');
		$options[] = array('value'=>'bounceOutUp', 'label'=>'bounceOutUp');
		$options[] = array('value'=>'fadeOut', 'label'=>'fadeOut');
		$options[] = array('value'=>'fadeOutDown', 'label'=>'fadeOutDown');
		$options[] = array('value'=>'fadeOutDownBig', 'label'=>'fadeOutDownBig');
		$options[] = array('value'=>'fadeOutLeft', 'label'=>'fadeOutLeft');
		$options[] = array('value'=>'fadeOutLeftBig', 'label'=>'fadeOutLeftBig');
		$options[] = array('value'=>'fadeOutRight', 'label'=>'fadeOutRight');
		$options[] = array('value'=>'fadeOutRightBig', 'label'=>'fadeOutRightBig');
		$options[] = array('value'=>'fadeOutUp', 'label'=>'fadeOutUp');
		$options[] = array('value'=>'fadeOutUpBig', 'label'=>'fadeOutUpBig');
		$options[] = array('value'=>'flipOutX', 'label'=>'flipOutX');
		$options[] = array('value'=>'flipOutY', 'label'=>'flipOutY');
		$options[] = array('value'=>'lightSpeedOut', 'label'=>'lightSpeedOut');
		$options[] = array('value'=>'rotateOut', 'label'=>'rotateOut');
		$options[] = array('value'=>'rotateOutDownLeft', 'label'=>'rotateOutDownLeft');
		$options[] = array('value'=>'rotateOutDownRight', 'label'=>'rotateOutDownRight');
		$options[] = array('value'=>'rotateOutUpLeft', 'label'=>'rotateOutUpLeft');
		$options[] = array('value'=>'rotateOutUpRight', 'label'=>'rotateOutUpRight');
		$options[] = array('value'=>'slideOutUp', 'label'=>'slideOutUp');
		$options[] = array('value'=>'slideOutDown', 'label'=>'slideOutDown');
		$options[] = array('value'=>'slideOutLeft', 'label'=>'slideOutLeft');
		$options[] = array('value'=>'slideOutRight', 'label'=>'slideOutRight');
		$options[] = array('value'=>'zoomOut', 'label'=>'zoomOut');
		$options[] = array('value'=>'zoomOutDown', 'label'=>'zoomOutDown');
		$options[] = array('value'=>'zoomOutLeft', 'label'=>'zoomOutLeft');
		$options[] = array('value'=>'zoomOutRight', 'label'=>'zoomOutRight');
		$options[] = array('value'=>'zoomOutUp', 'label'=>'zoomOutUp');
		$options[] = array('value'=>'rollOut', 'label'=>'rollOut');
		
		
		return $options;
	}
}