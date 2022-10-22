<?php

namespace App\Entity;

use App\Repository\CommunityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommunityRepository::class)]
class Community
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'community', targetEntity: Province::class, orphanRemoval: true)]
    private Collection $provinces;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?municipality $capital = null;

    public function __construct()
    {
        $this->provinces = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     */
    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getProvinces(): ArrayCollection|Collection
    {
        return $this->provinces;
    }

    /**
     * @param ArrayCollection|Collection $provinces
     */
    public function setProvinces(ArrayCollection|Collection $provinces): void
    {
        $this->provinces = $provinces;
    }

    /**
     * @return municipality|null
     */
    public function getCapital(): ?municipality
    {
        return $this->capital;
    }

    /**
     * @param municipality|null $capital
     */
    public function setCapital(?municipality $capital): void
    {
        $this->capital = $capital;
    }
}
