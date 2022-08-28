<?php

namespace App\Attribute\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity, ORM\Table(name: 'item')]
class Item
{
    #[ORM\Id, ORM\Column(type: 'integer'), ORM\GeneratedValue]
    private int $id;
    #[ORM\Column(type: 'string')]
    private string $sku;
    #[ORM\Column(type: 'string')]
    private string $type;
    #[ORM\Column(type: 'string')]
    private string $name;
    #[ORM\Column(type: 'string')]
    private string $description;
    #[ORM\Column(type: 'integer')]
    private int $shopId;
    #[ORM\Column(type: 'boolean')]
    private bool $isFree;
    #[ORM\Column(type: 'boolean')]
    private bool $isEnabled;
    #[ORM\Column(type: 'boolean')]
    private bool $isDeleted;
    #[ORM\OneToMany(mappedBy: 'item', targetEntity: ItemPrice::class)]
    private Collection $prices;
    #[ORM\OneToMany(mappedBy: 'item', targetEntity: ItemMedia::class)]
    private Collection $media;
    #[ORM\OneToMany(mappedBy: 'item', targetEntity: ItemAttribute::class)]
    private Collection $attributes;
    #[ORM\ManyToMany(mappedBy: 'items', targetEntity: ItemGroup::class)]
    private Collection $groups;
}
