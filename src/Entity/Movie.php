<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("movie")]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    #[Groups("movie")]
    private ?string $title = null;

    #[ORM\Column(length: 2000)]
    #[Groups("movie")]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups("movie")]
    private ?int $runtime = null;

    #[ORM\Column]
    #[Groups("movie")]
    private ?int $budget = null;

    #[ORM\Column(length: 250)]
    #[Groups("movie")]
    private ?string $poster = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups("movie")]
    private ?\DateTimeInterface $release_date = null;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups("movie")]
    private ?Genre $genre = null;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups("movie")]
    private ?Country $contry = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getRuntime(): ?int
    {
        return $this->runtime;
    }

    public function setRuntime(int $runtime): static
    {
        $this->runtime = $runtime;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(int $budget): static
    {
        $this->budget = $budget;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): static
    {
        $this->poster = $poster;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->release_date;
    }

    public function setReleaseDate(\DateTimeInterface $release_date): static
    {
        $this->release_date = $release_date;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getContry(): ?Country
    {
        return $this->contry;
    }

    public function setContry(?Country $contry): static
    {
        $this->contry = $contry;

        return $this;
    }
}
