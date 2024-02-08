<?php

namespace App\Entity;

use App\Entity\Trait\WithCompte;
use App\Repository\CompteRepository;
use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Eltharin\AutomaticQueryBuilderBundle\Annotations\PoweredField;
use Eltharin\AutomaticQueryBuilderBundle\Repository\PoweredRepository;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: 'integer')]
	private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[ORM\OneToMany(targetEntity: ItemSerie::class, mappedBy: 'item')]
    private $itemSeries;

    public function __construct()
    {
        $this->itemSeries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

	/**
	 * @return Collection<int, ItemSerie>
	 */
	public function getItemSeries(): Collection
	{
		return $this->itemSeries;
	}

	public function addItemSeries(ItemSerie $itemSeries): self
	{
		if (!$this->itemSeries->contains($itemSeries)) {
			$this->itemSeries[] = $itemSeries;
			$itemSeries->setItem($this);
		}

		return $this;
	}

	public function removeItemSeries(ItemSerie $itemSeries): self
	{
		if ($this->itemSeries->removeElement($itemSeries)) {
			// set the owning side to null (unless already changed)
			if ($itemSeries->getItem() === $this) {
				$itemSeries->setItem(null);
			}
		}

		return $this;
	}

}
