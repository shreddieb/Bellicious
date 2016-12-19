<?php
/**
 *
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs
 * Please refer to http://www.magentocommerce.com for more information.
 * @package   Comming soon page
 * @version   1.0.0
 */
?>
<?php
class Mdl_UnderConstruction_Model_Source_Bgposition
{
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