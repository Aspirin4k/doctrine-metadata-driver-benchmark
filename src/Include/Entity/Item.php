<?php

namespace App\Include\Entity;

use Doctrine\Common\Collections\Collection;

class Item
{
    private int $id;
    private string $sku;
    private string $type;
    private string $name;
    private string $description;
    private int $shopId;
    private bool $isFree;
    private bool $isEnabled;
    private bool $isDeleted;
    private Collection $prices;
    private Collection $media;
    private Collection $attributes;
    private Collection $groups;
}
