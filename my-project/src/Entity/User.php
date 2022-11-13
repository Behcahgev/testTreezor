<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 2,
        max: 20,
        minMessage: 'Le nom doit faire au moins {{ limit }} caractères',
        maxMessage: 'Le nom ne peut excéder {{ limit }} caractères',
    )]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    private ?string $last_name = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 2,
        max: 20,
        minMessage: 'Le prénom doit faire au moins {{ limit }} caractères',
        maxMessage: 'Le prénom ne peut excéder {{ limit }} caractères',
    )]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email(
        message: 'L\'email {{ value }} n\'est pas valide',
    )]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\DateTimeInterface]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    private ?\DateTimeInterface $birthday_date = null;

    #[ORM\Column( options: ["default" => 0])]
    private ?bool $active = null;

    public function __construct() 
    {
        $this->active = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBirthdayDate(): ?\DateTimeInterface
    {
        return $this->birthday_date;
    }

    public function setBirthdayDate(\DateTimeInterface $birthday_date): self
    {
        $this->birthday_date = $birthday_date;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
