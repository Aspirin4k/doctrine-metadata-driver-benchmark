<?php

namespace App\Annotation\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="item_price")
 */
class ItemPrice
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;
    /**
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="prices")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    private Item $item;
    /**
     * @ORM\Column(type="string")
     */
    private string $amount;
    /**
     * @ORM\Column(type="string")
     */
    private string $currency;
}
