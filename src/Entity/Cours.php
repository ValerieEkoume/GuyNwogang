<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 */
class Cours
{
    const NIVEAU = [
        0 => 'Kops',
        1 => 'Kopss',
        2 => 'Kopsss'

    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $niveau;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $free = false;

    public function __construct()
    {
        $this->created_at = new \DateTime();

    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getFormatedPrix():string
    {
        return number_format($this->prix, 0, '', '');
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getCeatedAt(): ?\DateTimeInterface
    {
        return $this->ceated_at;
    }

    public function setCeatedAt(\DateTimeInterface $ceated_at): self
    {
        $this->ceated_at = $ceated_at;

        return $this;
    }

    public function getFree(): ?bool
    {
        return $this->free;
    }

    public function setFree(bool $free): self
    {
        $this->free = $free;

        return $this;
    }
}
