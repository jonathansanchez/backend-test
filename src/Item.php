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
}
