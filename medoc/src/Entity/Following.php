<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Mybase\Entity\BaseEntity;
use App\Repository\FollowingRepository;

#[ORM\Entity(repositoryClass: FollowingRepository::class)]

class Following extends BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $morning = null;

    #[ORM\Column(length: 255)]
    private ?string $afternoon = null;

    #[ORM\Column(length: 255)]
    private ?string $evening = null;

    #[ORM\Column]
    private ?int $during = null;

    #[ORM\Column]
    private ?int $counting = null;

    #[ORM\Column]
    private ?bool $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getMorning(): ?string
    {
        return $this->morning;
    }

    public function setMorning(string $morning): static
    {
        $this->morning = $morning;

        return $this;
    }

    public function getAfternoon(): ?string
    {
        return $this->afternoon;
    }

    public function setAfternoon(string $afternoon): static
    {
        $this->afternoon = $afternoon;

        return $this;
    }

    public function getEvening(): ?string
    {
        return $this->evening;
    }

    public function setEvening(string $evening): static
    {
        $this->evening = $evening;

        return $this;
    }

    public function getDuring(): ?int
    {
        return $this->during;
    }

    public function setDuring(int $during): static
    {
        $this->during = $during;

        return $this;
    }

    public function getCounting(): ?int
    {
        return $this->counting;
    }

    public function setCounting(int $counting): static
    {
        $this->counting = $counting;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

        return $this;
    }
}
