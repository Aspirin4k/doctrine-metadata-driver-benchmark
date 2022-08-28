<?php

namespace App\Include\Entity;

use Doctrine\Common\Collections\Collection;

class ItemGroup
{
    private int $id;
    private string $externalId;
    private string $name;
    private Collection $items;
}
