
<?php
class Mdl_UnderConstruction_Block_Adminhtml_System_Config_Form_Field_Calendar extends Mage_Adminhtml_Block_System_Config_Form_Field{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element){
        $html = parent::_getElementHtml($element);
        if ( !Mage::registry('mCalendar') ) {
            $html .= '
			    <link href="'.$this->getJsUrl('bootstrap/jquery.datetimepicker.css').'" rel="stylesheet" type="text/css">
                <script type="text/javascript">
				jQuery("#underConstruction_settings_endDate").datetimepicker({
					format:"d M Y H:i"	
				});
                </script>
                ';
            Mage::register('mCalendar', 1);
        }
        return $html;
    }
}