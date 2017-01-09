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
class Mdl_UnderConstruction_Model_Source_Styles
{
    public function toOptionArray() {
		$options = array();
		$options[] = array('value'=>'no-repeat', 'label'=>'No Repeat');
		$options[] = array('value'=>'repeat', 'label'=>'Repeat');
		$options[] = array('value'=>'repeat-x', 'label'=>'Repeat-x');
		$options[] = array('value'=>'repeat-y', 'label'=>'Repeat-x');
		return $options;
	}
}
?>