<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LibraryRepository;
use Doctrine\Common\Collections\Collection;
use phpDocumentor\Reflection\Types\Nullable;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: LibraryRepository::class)]
class Library
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    #[ORM\OneToMany(mappedBy: 'libraryId', targetEntity: Stock::class, orphanRemoval: true)]
    #[ORM\Column(nullable: true)]
    private ?Collection $stocks;

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
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

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return Collection<int, Stock>
     */
    public function getStocks(): ?Collection
    {
        return $this->stocks;
    }

    public function addStock(?Stock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks->add($stock);
            if($stock){
                $stock->setLibraryId($this);
            }
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getLibraryId() === $this) {
                $stock->setLibraryId(null);
            }
        }

        return $this;
    }
}
