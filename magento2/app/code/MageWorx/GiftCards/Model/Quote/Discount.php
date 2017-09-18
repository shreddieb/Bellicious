<?php
/**
 * Copyright © 2016 MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace MageWorx\GiftCards\Model\Quote;

use Magento\Framework\Event\Observer;
use Magento\Framework\App\Request\Http as Request;

class Discount extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
    /**
     * Discount calculation object
     *
     * @var \Magento\SalesRule\Model\Validator
     */
    protected $calculator;

    /**
     * Core event manager proxy
     *
     * @var \Magento\Framework\Event\ManagerInterface
     */
    protected $eventManager = null;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Framework\Pricing\PriceCurrencyInterface
     */
    protected $priceCurrency;

    /**
     * @var \MageWorx\GiftCards\Model\Session
     */
    protected $giftcardsSession;

    /**
     * @var \MageWorx\GiftCards\Model\ResourceModel\GiftCards\CollectionFactory
     */
    protected $giftcardsCollection;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $cards = [];

    protected $giftCardBalance;
    protected $baseGiftCardBalance;
    protected $origGiftCardBalance;
    protected $origBaseGiftCardBalance;
    protected $shippingDiscountAdditional;
    protected $baseShippingDiscountAdditional;
    protected $shippingDiscount;
    protected $baseShippingDiscount;


    /**
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\SalesRule\Model\Validator $validator
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     */
    public function __construct(
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \MageWorx\GiftCards\Model\Session $giftcardsSession,
        \MageWorx\GiftCards\Model\ResourceModel\GiftCards\CollectionFactory $giftcardsCollection,
        Request $request,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->eventManager = $eventManager;
        $this->storeManager = $storeManager;
        $this->priceCurrency = $priceCurrency;
        $this->giftcardsSession = $giftcardsSession;
        $this->giftcardsCollection = $giftcardsCollection;
        $this->logger = $logger;
        $this->request   = $request;
    }

    /**
     * Collect address discount amount
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return $this
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);

        $store = $this->storeManager->getStore($quote->getStoreId());
        $address = $shippingAssignment->getShipping()->getAddress();

        $items = $shippingAssignment->getItems();
        if (!count($items)) {
            return $this;
        }

        $eventArgs = [
            'website_id' => $store->getWebsiteId(),
            'customer_group_id' => $quote->getCustomerGroupId(),
        ];

        $quote->setUseGiftCard(true);
        $giftcardsIds = $this->giftcardsSession->getGiftCardsIds() ? $this->giftcardsSession->getGiftCardsIds() : [];

        $this->giftCardBalance = 0;
        $this->baseGiftCardBalance = 0;
        $this->origGiftCardBalance = 0;
        $this->origBaseGiftCardBalance = 0;
        $this->shippingDiscountAdditional = 0;
        $this->baseShippingDiscountAdditional = 0;
        $this->shippingDiscount = 0;
        $this->baseShippingDiscount = 0;
        
        $giftCardsDiscount = 0;
        $baseGiftCardsDiscount = 0;
        
        
        $usedCards = [];

        if ($this->giftcardsSession->getActive() || $this->giftcardsSession->getIsReadyToClean()) {
            $cards = $this->giftcardsCollection->create()->addFieldToFilter('card_id', ['in' => array_keys($giftcardsIds)])->load();
            foreach ($cards as $card) {
                $this->cards[$card->getId()] = ['balance' => $card->getCardBalance(), 'code' => $card->getCardCode()];
            }
            foreach ($this->cards as $id => $_card) {
                $this->giftCardBalance = $_card['balance'];
                $this->baseGiftCardBalance = $_card['balance'];
                $this->origGiftCardBalance = $_card['balance'];
                $this->origBaseGiftCardBalance = $_card['balance'];

                /** @var \Magento\Quote\Model\Quote\Item $item */
                foreach ($items as $item) {
                    // to determine the child item discount, we calculate the parent
                    if ($item->getParentItem()) {
                        continue;
                    }

                    $eventArgs['item'] = $item;
                    $this->eventManager->dispatch('sales_quote_address_discount_item', $eventArgs);

                    if ($item->getHasChildren() && $item->isChildrenCalculated()) {
                        $this->setItemDiscount($item);
                        $giftCardsDiscount += $item->getDiscountAmount();
                        $baseGiftCardsDiscount += $item->getBaseDiscountAmount();

                        foreach ($item->getChildren() as $child) {
                            $this->setItemDiscount($child);
                            $giftCardsDiscount += $child->getDiscountAmount();
                            $baseGiftCardsDiscount += $child->getBaseDiscountAmount();
                        }
                    } else {
                        $this->setItemDiscount($item);
                        $giftCardsDiscount += $item->getDiscountAmount();
                        $baseGiftCardsDiscount += $item->getBaseDiscountAmount();
                    }
                }

                if ($this->giftCardBalance > 0 && $address->getShippingAmount()) {
                    $shippingDiscount = $address->getShippingDiscountAmount();
                    if ($address->getShippingAmount() > $this->giftCardBalance + $shippingDiscount) {
                        $address->setShippingDiscountAmount($this->giftCardBalance + $shippingDiscount);
                        $this->shippingDiscount += $this->giftCardBalance;
                        $this->giftCardBalance = 0;
                    } else {
                        $delta = $address->getShippingAmount() - $shippingDiscount;
                        $address->setShippingDiscountAmount($delta + $shippingDiscount);
                        $this->shippingDiscount += $delta;
                        $this->giftCardBalance -= $delta;
                    }
                    
                    $baseShippingDiscount = $address->getBaseShippingDiscountAmount();
                    if ($address->getBaseShippingAmount() > $this->baseGiftCardBalance + $baseShippingDiscount) {
                        $address->setBaseShippingDiscountAmount($this->baseGiftCardBalance + $baseShippingDiscount);
                        $this->baseShippingDiscount += $this->baseGiftCardBalance;
                        $this->baseGiftCardBalance = 0;
                    } else {
                        $delta = $address->getBaseShippingAmount() - $baseShippingDiscount;
                        $address->setBaseShippingDiscountAmount($delta + $baseShippingDiscount);
                        $this->baseShippingDiscount += $delta;
                        $this->baseGiftCardBalance -= $delta;
                    }
                }

                $usedCards[$id]['balance'] = $this->origGiftCardBalance - $item->getDiscountAmount() - $address->getShippingDiscountAmount();
            }

            /** Process shipping amount discount */
            if ($this->shippingDiscount) {
                $giftCardsDiscount += $this->shippingDiscount;
                $baseGiftCardsDiscount += $this->baseShippingDiscount;
            }
            
            $description = '';
            $descriptionArray = $address->getDiscountDescriptionArray();
            
            if ($descriptionArray === null) {
                $descriptionArray = [];
            }
            
            foreach ($this->cards as $key => $_card) {
                $description .= ' '.$_card['code'];
                $descriptionArray[$key] = $_card['code'];
            }

            $address->setDiscountDescriptionArray($descriptionArray);
            $this->prepareDescription($address);

            $total->addTotalAmount('mageworx_giftcards', -$giftCardsDiscount);
            $total->addBaseTotalAmount('mageworx_giftcards', -$baseGiftCardsDiscount);

            $total->setDiscountDescription($address->getDiscountDescription());

            $total->setSubtotalWithDiscount($total->getSubtotal() - $giftCardsDiscount);
            $total->setBaseSubtotalWithDiscount($total->getBaseSubtotal() - $baseGiftCardsDiscount);

            $quote->setMageworxGiftcardsAmount(-$giftCardsDiscount);
            $quote->setBaseMageworxGiftcardsAmount(-$baseGiftCardsDiscount);
            $quote->setMageworxGiftcardsDescription(' Gift Card ('.implode(',', $descriptionArray).')');

            $quote->setSubtotalWithDiscount($total->getSubtotal() - $giftCardsDiscount);
            $quote->setBaseSubtotalWithDiscount($total->getBaseSubtotal() - $baseGiftCardsDiscount);

            $quote->setGiftCardsIds($this->cards);

            $frontData = [];
            foreach ($this->cards as $key => $value) {
                $frontData[$key]['applied'] = $value['balance'] - $usedCards[$key]['balance'];
                $frontData[$key]['remaining'] = $usedCards[$key]['balance'];
                $frontData[$key]['code'] = $value['code'];
            }

            $this->giftcardsSession->setFrontOptions($frontData);

            if ($this->giftcardsSession->getIsReadyToClean()) {
                $this->giftcardsSession->setIsReadyToClean(0);
            }
        }
        return $this;
    }
    
    protected function setItemDiscount(\Magento\Quote\Model\Quote\Item\AbstractItem $item)
    {
        if ($this->giftCardBalance < 0) {
            return;
        }

        $qty = $item->getQty();
        $itemPrice = $item->getData('price') * $qty + $item->getTaxAmount();
        $itemDiscountAmount = $item->getDiscountAmount() ? abs($item->getDiscountAmount()) : 0;
        $baseItemPrice = $item->getData('base_price') * $qty + $item->getBaseTaxAmount();
        $baseItemDiscountAmount = $item->getBaseDiscountAmount() ? abs($item->getBaseDiscountAmount()) : 0;
        $rest = $itemPrice - $itemDiscountAmount;
        $baseRest = $baseItemPrice - $baseItemDiscountAmount;
        if ($rest < $this->giftCardBalance) {
            $discount = $rest;
            $item->setDiscountAmount($discount + $itemDiscountAmount);
            $this->giftCardBalance -= $discount;
        } else {
            $discount = $this->giftCardBalance;
            $item->setDiscountAmount($discount + $itemDiscountAmount);
            $this->giftCardBalance = 0;
        }


        if ($baseRest < $this->baseGiftCardBalance) {
            $baseDiscount = $baseRest;
            $item->setBaseDiscountAmount($baseDiscount + $baseItemDiscountAmount);
            $this->baseGiftCardBalance -= $baseDiscount;
        } else {
            $baseDiscount = $this->baseGiftCardBalance;
            $item->setBaseDiscountAmount($baseDiscount + $baseItemDiscountAmount);
            $this->baseGiftCardBalance = 0;
        }
    }

    /**
     * Distribute discount at parent item to children items
     *
     * @param \Magento\Quote\Model\Quote\Item\AbstractItem $item
     * @return $this
     */
    protected function distributeDiscount(\Magento\Quote\Model\Quote\Item\AbstractItem $item)
    {
        $parentBaseRowTotal = $item->getBaseRowTotal();
        $keys = [
            'discount_amount',
            'base_discount_amount',
            'original_discount_amount',
            'base_original_discount_amount',
        ];
        $roundingDelta = [];
        foreach ($keys as $key) {
            //Initialize the rounding delta to a tiny number to avoid floating point precision problem
            $roundingDelta[$key] = 0.0000001;
        }
        foreach ($item->getChildren() as $child) {
            $ratio = $child->getBaseRowTotal() / $parentBaseRowTotal;
            foreach ($keys as $key) {
                if (!$item->hasData($key)) {
                    continue;
                }
                $value = $item->getData($key) * $ratio;
                $roundedValue = $this->priceCurrency->round($value + $roundingDelta[$key]);
                $roundingDelta[$key] += $value - $roundedValue;
                $child->setData($key, $roundedValue);
            }
        }

        foreach ($keys as $key) {
            $item->setData($key, 0);
        }
        return $this;
    }

    /**
     * Add discount total information to address
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return array|null
     */
    public function fetch(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total)
    {
        $result = null;
        $amount = $total->getMageworxGiftcardsAmount();

        if ($amount != 0) {
            $description = $total->getDiscountDescription();
            $result = [
                'code' => 'mageworx_giftcards',
                'title' => strlen($description) ? __('Gift Card (%1)', $description) : __('Gift Card'),
                'value' => $amount,
            ];
        }
        return $result;
    }

    public function prepareDescription($address, $separator = ', ')
    {
        $descriptionArray = $address->getDiscountDescriptionArray();
        if (!$descriptionArray && $address->getQuote()->getItemVirtualQty() > 0) {
            $descriptionArray = $address->getQuote()->getBillingAddress()->getDiscountDescriptionArray();
        }

        $description = $descriptionArray && is_array(
            $descriptionArray
        ) ? implode(
            $separator,
            array_unique($descriptionArray)
        ) : '';

        $address->setDiscountDescription($description);
        return $this;
    }
}
