
<?php
class Mdl_Brand_Block_Adminhtml_Brand extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
     
     $this->_controller = 'adminhtml_Brand';
     $this->_blockGroup = 'brand';
     //text in the admin header
     $this->_headerText = 'Brand Management';
     //value of the add button
     $this->_addButtonLabel = 'Add Brand';
     parent::__construct();
     }
}