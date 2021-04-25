<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 * @UniqueEntity("title")
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks()
 */
class Cours
{
    use Timestampable;

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
     * @Assert\Length(min=3, max=40)
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
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $free = false;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min="2", max="5")
     */
    private $parts;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="cours_image", fileNameProperty="imageName")
     * @Assert\Image(maxSize="1M")
     * @Assert\NotNull(message="Please upload an image")
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageName;

    /**
     * @ORM\OneToMany(targetEntity=Video::class, mappedBy="cours")
     */
    private $videos;



    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->videos = new ArrayCollection();

    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug() : string
    {
        return (new Slugify())->slugify($this->title);
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

    public function getNiveauType() : string
    {
        return self ::NIVEAU[$this->niveau];
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



    public function getParts(): ?int
    {
        return $this->parts;
    }

    public function setParts(int $parts): self
    {
        $this->parts = $parts;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }



    public function updateTimeStamp()
    {
        if ($this->getCreatedAt() === null){
            $this->setCreatedAt(new \DateTimeImmutable());
        }
        $this->setUpdatedAt(new  \DateTimeImmutable());

    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setCours($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getCours() === $this) {
                $video->setCours(null);
            }
        }

        return $this;
    }


}
