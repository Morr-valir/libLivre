<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoryRepository;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;


#[ApiResource(
    normalizationContext: ['groups' => ['GetCollectionCategory']],
    denormalizationContext: ['groups' => ['GetCollectionCategory']],
    operations:[
        new Get(),
        new GetCollection(),
    ],)]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["GetCollectionBooks","GetCollectionCategory"])]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    #[Groups(["GetCollectionBooks","GetCollectionCategory"])]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups("GetCollectionCategory")]
    private ?bool $isForAdult = null;

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

    public function isIsForAdult(): ?bool
    {
        return $this->isForAdult;
    }

    public function setIsForAdult(bool $isForAdult): self
    {
        $this->isForAdult = $isForAdult;

        return $this;
    }
    public function __toString()
    {
        return $this->getName();
    }
}
