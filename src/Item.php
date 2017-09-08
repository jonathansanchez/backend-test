<?php

namespace Runroom\GildedRose;

class Item
{
    private $name;
    private $sell_in;
    private $quality;

    public function __construct(string $name, int $sell_in, int $quality)
    {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function sell_in(): int
    {
        return $this->sell_in;
    }

    public function decreaseSellIn(int $value): void
    {
        $this->sell_in = $this->sell_in - $value;
    }

    public function quality(): int
    {
        return $this->quality;
    }

    public function increaseQuality(int $value): void
    {
        $this->quality = $this->quality + $value;
    }

    public function decreaseQuality(int $value): void
    {
        $this->quality = $this->quality - $value;
    }
}
