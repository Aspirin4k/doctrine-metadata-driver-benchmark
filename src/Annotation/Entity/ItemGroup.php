<?php

namespace App\Annotation\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="item_group")
 */
class ItemGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;
    /**
     * @ORM\Column(type="string")
     */
    private string $externalId;
    /**
     * @ORM\Column(type="string")
     */
    private string $name;
    /**
     * @ORM\ManyToMany(targetEntity="Item", inversedBy="groups")
     * @ORM\JoinTable(name="item_in_group")
     */
    private Collection $items;
}
