<?php
class Mdl_Ajaxnav_Block_Layer_Filter_Categorysearch extends Mdl_Ajaxnav_Block_Layer_Filter_Category
{
    public function __construct()
    {
        parent::__construct();
		//Load Custom PHTML of category search
        $this->setTemplate('mdl/ajaxnav/filter_category_search.phtml');
		//Set Filter Model Name
        $this->_filterModelName = 'ajaxnav/layer_filter_categorysearch'; 
    }  
} 