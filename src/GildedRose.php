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
            if ($item->name() != 'Aged Brie' and $item->name() != 'Backstage passes to a TAFKAL80ETC concert') {
                if ($this->hasPassedMinQuantityValue($item)) {
                    if ($item->name() != 'Sulfuras, Hand of Ragnaros') {
                        $item->decreaseQuality(1);
                    }
                }
            } else {
                if ($this->hasNotReachedMaxQuantityVaue($item)) {
                    $item->increaseQuality(1);
                    if ($item->name() == 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->sell_in() < self::MAX_BACKSTAGE_PASS_SELL_IN) {
                            if ($this->hasNotReachedMaxQuantityVaue($item)) {
                                $item->increaseQuality(1);
                            }
                        }
                        if ($item->sell_in() < self::MIN_BACKSTAGE_PASS_SELL_IN) {
                            if ($this->hasNotReachedMaxQuantityVaue($item)) {
                                $item->increaseQuality(1);
                            }
                        }
                    }
                }
            }

            if ($item->name() != 'Sulfuras, Hand of Ragnaros') {
                $item->decreaseSellIn(1);
            }

            if ($item->sell_in() < self::MIN_SELL_IN_DAYS) {
                if ($item->name() != 'Aged Brie') {
                    if ($item->name() != 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($this->hasPassedMinQuantityValue($item)) {
                            if ($item->name() != 'Sulfuras, Hand of Ragnaros') {
                                $item->decreaseQuality(1);
                            }
                        }
                    } else {
                        $item->decreaseQuality($item->quality());
                    }
                } else {
                    if ($this->hasNotReachedMaxQuantityVaue($item)) {
                        $item->increaseQuality(1);
                    }
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
}
