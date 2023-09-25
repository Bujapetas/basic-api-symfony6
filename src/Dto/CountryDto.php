<?php

namespace App\Dto;
use Symfony\Component\Validator\Constraints as Assert;
class CountryDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    public ?string $name = null;
}