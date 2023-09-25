<?php

namespace App\Dto;
use Symfony\Component\Validator\Constraints as Assert;

class GenreDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 120)]
    public ?string $name = null;
}