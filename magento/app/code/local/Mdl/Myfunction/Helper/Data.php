<?php
class Mdl_Myfunction_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function specialPriceDiscount($_product)
    {
        $specialPrice = $_product->getSpecialPrice();
		$specialFromDate = $_product->getSpecialFromDate();
		$specialToDate = $_product->getSpecialToDate();
		$currentDate = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
        if($specialPrice){
			if($specialFromDate && $specialToDate)
			{
				if($specialFromDate<=$currentDate && $specialToDate>=$currentDate)
				{
					$basePrice = $_product->getPrice();
					$differencePrice = $basePrice - $specialPrice;
					$percentage = ($differencePrice / $basePrice) * 100 ;
					return '<span class="salePrice"> '.round($percentage).'%</span>';
				}
			}
			else
			{
            $basePrice = $_product->getPrice();
            $differencePrice = $basePrice - $specialPrice;
            $percentage = ($differencePrice / $basePrice) * 100 ;
            return '<span class="salePrice"> - '.round($percentage).'%</span>';
			}
        }
        else
        {
            return;
        }               
    }
}