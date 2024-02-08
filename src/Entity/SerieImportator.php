<?php

namespace App\Entity;

use App\Repository\SerieImportatorRepository;
use Doctrine\ORM\Mapping as ORM;
use Eltharin\AutomaticQueryBuilderBundle\Annotations\PoweredField;

#[ORM\Entity(repositoryClass: SerieImportatorRepository::class)]
class SerieImportator
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne( inversedBy: 'serieImportators')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Serie $serie = null;

	#[ORM\Column(type: 'string', length: 255)]
	private $libelle;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): static
    {
        $this->serie = $serie;

        return $this;
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
}
