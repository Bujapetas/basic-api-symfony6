<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class MovieDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 120)]
    public ?string $title = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 2000)]
    public ?string $description = null;

    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    public ?int $runtime = null;

    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    public ?int $budget = null;

    #[Assert\Blank]
    #[Assert\Url]
    public ?string $poster = null;

    #[Assert\NotBlank]
    #[Assert\Type("\DateTimeInterface")]
    public ?\DateTimeInterface $release_date = null;

    #[Assert\NotBlank]
    #[Assert\Positive]
    public $genre;

    #[Assert\NotBlank]
    #[Assert\Positive]
    public $country; // You might want to add further validation here
}