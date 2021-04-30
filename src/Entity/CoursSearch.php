<?php

namespace App\Entity;


class CoursSearch
{

    /**
     * @var string|null
     */
    private $genre;

    /**
     * @var string|null
     */
    private $niveau;


    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    /**
     * @param string|null $niveau
     */
    public function setNiveau(?string $niveau): void
    {
        $this->niveau=$niveau;
    }
}
