<?php

namespace Runroom\GildedRose;

class GildedRose
{
    const MIN_QUANTITY_VALUE         = 0;
    const MAX_QUANTITY_VALUE         = 50;
    const MIN_SELL_IN_DAYS           = 0;
    const MIN_BACKSTAGE_PASS_SELL_IN = 6;
    const MAX_BACKSTAGE_PASS_SELL_IN = 11;
    private $items;

    function __construct($items)
    {
        $this->items = $items;
    }

    function update_quality()
    {
        foreach ($this->items as $item) {
            if ($item->name() == 'Sulfuras, Hand of Ragnaros') {
                break;
            }

            if ($item->name() == 'Aged Brie') {
                if ($this->hasNotReachedMaxQuantityVaue($item)) {
                    $item->increaseQuality(2);
                }

                if ($this->noDaysRemaining($item)) {
                    if ($this->hasNotReachedMaxQuantityVaue($item)) {
                        $item->increaseQuality(1);
                    }
                }
                break;
            }

            if ($item->name() == 'Backstage passes to a TAFKAL80ETC concert') {
                if ($this->hasNotReachedMaxQuantityVaue($item)) {
                    $item->increaseQuality(1);
                    if ($this->stillHaveDaysToSell($item)) {
                        $item->increaseQuality(1);
                    }
                    if ($this->notDaysToSell($item)) {
                        $item->increaseQuality(1);
                    }
                }

                $item->decreaseSellIn(1);

                if ($this->noDaysRemaining($item)) {
                    $item->decreaseQuality($item->quality());
                }
                break;
            }

            if ($this->hasPassedMinQuantityValue($item)) {
                $item->decreaseQuality(1);
            }

            $item->decreaseSellIn(1);

            if ($this->noDaysRemaining($item)) {
                if ($this->hasPassedMinQuantityValue($item)) {
                    $item->decreaseQuality(1);
                }
            }
        }
    }

    private function hasPassedMinQuantityValue(Item $item): bool
    {
        return $item->quality() > self::MIN_QUANTITY_VALUE;
    }

    private function hasNotReachedMaxQuantityVaue(Item $item): bool
    {
        return $item->quality() < self::MAX_QUANTITY_VALUE;
    }

    private function stillHaveDaysToSell(Item $item): bool
    {
        return $item->sell_in() < self::MAX_BACKSTAGE_PASS_SELL_IN;
    }

    private function notDaysToSell(Item $item): bool
    {
        return $item->sell_in() < self::MIN_BACKSTAGE_PASS_SELL_IN;
    }

    private function noDaysRemaining(Item $item): bool
    {
        return $item->sell_in() < self::MIN_SELL_IN_DAYS;
    }
}
