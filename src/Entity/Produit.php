<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(nullable: true)]
    private ?bool $active = null;

    #[ORM\ManyToMany(targetEntity: SousRubrique::class, inversedBy: 'produits')]
    private Collection $sous_rubrique;

    public function __construct()
    {
        $this->sous_rubrique = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection<int, SousRubrique>
     */
    public function getSousRubrique(): Collection
    {
        return $this->sous_rubrique;
    }

    public function addSousRubrique(SousRubrique $sousRubrique): self
    {
        if (!$this->sous_rubrique->contains($sousRubrique)) {
            $this->sous_rubrique->add($sousRubrique);
        }

        return $this;
    }

    public function removeSousRubrique(SousRubrique $sousRubrique): self
    {
        $this->sous_rubrique->removeElement($sousRubrique);

        return $this;
    }
}
