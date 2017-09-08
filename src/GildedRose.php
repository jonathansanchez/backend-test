<?php

namespace Runroom\GildedRose;

class GildedRose
{

    private $items;

    function __construct($items)
    {
        $this->items = $items;
    }

    function update_quality()
    {
        foreach ($this->items as $item) {
            if ($item->name() != 'Aged Brie' and $item->name() != 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->quality() > 0) {
                    if ($item->name() != 'Sulfuras, Hand of Ragnaros') {
                        $item->decreaseQuality(1);
                    }
                }
            } else {
                if ($item->quality() < 50) {
                    $item->increaseQuality(1);
                    if ($item->name() == 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->sell_in() < 11) {
                            if ($item->quality() < 50) {
                                $item->increaseQuality(1);
                            }
                        }
                        if ($item->sell_in() < 6) {
                            if ($item->quality() < 50) {
                                $item->increaseQuality(1);
                            }
                        }
                    }
                }
            }

            if ($item->name() != 'Sulfuras, Hand of Ragnaros') {
                $item->decreaseSellIn(1);
            }

            if ($item->sell_in() < 0) {
                if ($item->name() != 'Aged Brie') {
                    if ($item->name() != 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->quality() > 0) {
                            if ($item->name() != 'Sulfuras, Hand of Ragnaros') {
                                $item->decreaseQuality(1);
                            }
                        }
                    } else {
                        $item->decreaseQuality($item->quality());
                    }
                } else {
                    if ($item->quality() < 50) {
                        $item->increaseQuality(1);
                    }
                }
            }
        }
    }
}
