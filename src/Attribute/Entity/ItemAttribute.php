<?php

namespace App\Attribute\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity, ORM\Table(name: 'item_attribute')]
class ItemAttribute
{
    #[ORM\Id, ORM\Column(type: 'integer'), ORM\GeneratedValue]
    private int $id;
    #[
        ORM\ManyToOne(targetEntity: Item::class, inversedBy: 'attributes'),
        ORM\JoinColumn(name: 'item_id', referencedColumnName: 'id')
    ]
    private Item $item;
    #[ORM\Column(type: 'string')]
    private string $name;
    #[ORM\Column(type: 'string')]
    private string $value;
}
