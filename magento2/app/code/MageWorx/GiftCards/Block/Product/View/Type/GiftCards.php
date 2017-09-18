<?php
/**
 * Copyright © 2016 MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

/**
 * Giftcards product data view
 */
namespace MageWorx\GiftCards\Block\Product\View\Type;

class GiftCards extends \Magento\Catalog\Block\Product\View\AbstractView
{
    const PRICE_TYPE_CUSTOMER = 1;
    const PRICE_TYPE_SELECTED = 2;

    public $priceStatus;
    public $cardType;

    protected $giftcardsSession;
    
    protected $currency;
    
    protected $aAdditionalPrices;

    /** \MageWorx\GiftCards\Helper\Data */
    protected $helper;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Stdlib\ArrayUtils $arrayUtils,
        \Magento\Directory\Model\Currency $currency,
        \MageWorx\GiftCards\Helper\Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $arrayUtils, $data);
        $this->_isScopePrivate = true;
        $this->currency = $currency;
        $this->helper = $helper;
    }

    public function _construct()
    {
        $product = $this->getProduct();

        $this->cardType = $product->getData('mageworx_gc_type');

        if ($product->getData('price') == 0) {
            $this->initPriceStatus();
        }
        parent::_construct();
    }

    protected function initPriceStatus()
    {
        if ($this->getProduct()->getData('mageworx_gc_additional_price')) {
            $this->priceStatus = self::PRICE_TYPE_SELECTED;
            $this->aAdditionalPrices = explode(';', $this->getProduct()->getData('mageworx_gc_additional_price'));
        } else {
            $this->priceStatus = self::PRICE_TYPE_CUSTOMER;
        }
    }

    public function getPriceStatus()
    {
        return $this->priceStatus;
    }

    public function getCardType()
    {
        return $this->cardType;
    }
    
    public function getCurrency()
    {
        return $this->currency;
    }
    
    public function isShowMailDeliveryDate()
    {
        return $this->helper->getShowMailDeliveryDate();
    }
    
    public function getFromAmount()
    {
        return $this->helper->getMinCardValue();
    }

    public function getToAmount()
    {
        return $this->helper->getMaxCardValue();
    }
    
    public function getAdditionalPrice()
    {
        return $this->aAdditionalPrice;
    }
}
