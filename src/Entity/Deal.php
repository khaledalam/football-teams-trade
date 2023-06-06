<?php

namespace App\Entity;

use App\Repository\DealRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DealRepository::class)]
class Deal
{
    public const DEAL_STATUS_ACCEPTED = 'ACCEPTED';
    public const DEAL_STATUS_REJECTED = 'REJECTED';
    public const DEAL_STATUS_PENDING = 'PENDING';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'deals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Player $player = null;

    #[ORM\ManyToOne(inversedBy: 'deals_from')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $team_from = null;

    #[ORM\ManyToOne(inversedBy: 'deals_to')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $team_to = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?float $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getTeamFrom(): ?Team
    {
        return $this->team_from;
    }

    public function setTeamFrom(?Team $team_from): self
    {
        $this->team_from = $team_from;

        return $this;
    }

    public function getTeamTo(): ?Team
    {
        return $this->team_to;
    }

    public function setTeamTo(?Team $team_to): self
    {
        $this->team_to = $team_to;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
