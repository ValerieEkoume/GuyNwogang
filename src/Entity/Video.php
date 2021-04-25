<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\VideoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 */
class Video
{
    use Timestampable;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $videoTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $videoLink;

    /**
     * @ORM\ManyToOne(targetEntity=Cours::class, inversedBy="videos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cours;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVideoTitle(): ?string
    {
        return $this->videoTitle;
    }

    public function setVideoTitle(string $videoTitle): self
    {
        $this->videoTitle = $videoTitle;

        return $this;
    }

    public function getVideoLink(): ?string
    {
        return $this->videoLink;
    }

    public function setVideoLink(string $videoLink): self
    {
        $this->videoLink = $videoLink;

        return $this;
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): self
    {
        $this->cours = $cours;

        return $this;
    }
}
