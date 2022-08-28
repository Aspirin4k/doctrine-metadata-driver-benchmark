<?php

namespace App\Annotation\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="item")
 */
class Item
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
    private string $sku;
    /**
     * @ORM\Column(type="string")
     */
    private string $type;
    /**
     * @ORM\Column(type="string")
     */
    private string $name;
    /**
     * @ORM\Column(type="string")
     */
    private string $description;
    /**
     * @ORM\Column(type="integer")
     */
    private int $shopId;
    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isFree;
    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isEnabled;
    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isDeleted;
    /**
     * @ORM\OneToMany(targetEntity="ItemPrice", mappedBy="item")
     */
    private Collection $prices;
    /**
     * @ORM\OneToMany(targetEntity="ItemMedia", mappedBy="item")
     */
    private Collection $media;
    /**
     * @ORM\OneToMany(targetEntity="ItemMedia", mappedBy="item")
     */
    private Collection $attributes;
    /**
     * @ORM\ManyToMany(targetEntity="ItemGroup", mappedBy="items")
     */
    private Collection $groups;
}
