<?php

namespace App\Entity;

use App\Repository\ItemSerieRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ItemSerieRepository::class)]
class ItemSerie
{
	#[ORM\Id]
	#[ORM\ManyToOne( inversedBy: 'itemSeries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Item $item = null;

	#[ORM\Id]
    #[ORM\ManyToOne( inversedBy: 'itemSeries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Serie $serie = null;

    #[ORM\Column(type: 'string', length: 50)]
    private $number;

	public function getId(): ?int
    {
        return $this->id;
    }

    public function getItem(): ?item
    {
        return $this->item;
    }

    public function setItem(?item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getSerie(): ?serie
    {
        return $this->serie;
    }

    public function setSerie(?serie $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }
}
