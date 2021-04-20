<?php


namespace App\Entity\Traits;


use Doctrine\ORM\Mapping as ORM;

//Permet d'utiliser le trait dans d'autres Entités en utilisant use + nom de l'entité

trait Timestampable
{
    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $updatedAt;

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->ceatedAt = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}