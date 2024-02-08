<?php

namespace App\Entity;

use App\Entity\Trait\WithCompte;
use App\Repository\CompteRepository;
use App\Repository\SerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Eltharin\AutomaticQueryBuilderBundle\Annotations\PoweredField;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
class Serie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[ORM\OneToMany(mappedBy: 'serie', targetEntity: ItemSerie::class)]
    private $itemSeries;

    #[ORM\OneToMany(mappedBy: 'serie', targetEntity: SerieImportator::class)]
    private Collection $serieImportators;

    public function __construct()
    {
        $this->itemSeries = new ArrayCollection();
        $this->serieImportators = new ArrayCollection();
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
            $itemSeries->setSerie($this);
        }

        return $this;
    }

    public function removeItemSeries(ItemSerie $itemSeries): self
    {
        if ($this->itemSeries->removeElement($itemSeries)) {
            // set the owning side to null (unless already changed)
            if ($itemSeries->getSerie() === $this) {
                $itemSeries->setSerie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SerieImportator>
     */
    public function getSerieImportators(): Collection
    {
        return $this->serieImportators;
    }

    public function addSerieImportator(SerieImportator $serieImportator): static
    {
        if (!$this->serieImportators->contains($serieImportator)) {
            $this->serieImportators->add($serieImportator);
            $serieImportator->setSerie($this);
        }

        return $this;
    }

    public function removeSerieImportator(SerieImportator $serieImportator): static
    {
        if ($this->serieImportators->removeElement($serieImportator)) {
            // set the owning side to null (unless already changed)
            if ($serieImportator->getSerie() === $this) {
                $serieImportator->setSerie(null);
            }
        }

        return $this;
    }
}
