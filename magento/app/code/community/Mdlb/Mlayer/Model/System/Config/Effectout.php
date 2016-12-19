<?php

class Mdlb_Mlayer_Model_System_Config_Effectout 
{
	private $effectout ="pump,jump";
	
    public function toOptionArray()
    {
        $effectouts = explode(',', $this->effectout);
	    $options = array();
	    foreach ($$effectout as $effectoutoption ){
		    $options[] = array(
			    'value' => $effectoutoption,
			    'label' => $effectoutoption,
		    );
	    }

        return $options;
    }
}