<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
#[UniqueEntity('name')]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $country = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?float $money = 0;

    #[ORM\OneToMany(mappedBy: 'team', targetEntity: Player::class, cascade: ['persist', 'remove'])]
    private Collection $players;

    #[ORM\OneToMany(mappedBy: 'team_from', targetEntity: Deal::class, orphanRemoval: true)]
    private Collection $deals_from;

    #[ORM\OneToMany(mappedBy: 'team_to', targetEntity: Deal::class, orphanRemoval: true)]
    private Collection $deals_to;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?TeamManager $team_manager = null;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->deals_from = new ArrayCollection();
        $this->deals_to = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getMoney(): ?float
    {
        return $this->money;
    }

    public function setMoney(float $money): self
    {
        $this->money = $money;

        return $this;
    }

    /**
     * @return Collection<int, Player>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players->add($player);
            $player->setTeam($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getTeam() === $this) {
                $player->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Deal>
     */
    public function getDealsFrom(): Collection
    {
        return $this->deals_from;
    }

    public function addDealFrom(Deal $dealFrom): self
    {
        if (!$this->deals_from->contains($dealFrom)) {
            $this->deals_from->add($dealFrom);
            $dealFrom->setTeamFrom($this);
        }

        return $this;
    }

    public function removeDealFrom(Deal $dealFrom): self
    {
        if ($this->deals_from->removeElement($dealFrom)) {
            // set the owning side to null (unless already changed)
            if ($dealFrom->getTeamFrom() === $this) {
                $dealFrom->setTeamFrom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Deal>
     */
    public function getDealsTo(): Collection
    {
        return $this->deals_to;
    }

    public function addDealsTo(Deal $dealsTo): self
    {
        if (!$this->deals_to->contains($dealsTo)) {
            $this->deals_to->add($dealsTo);
            $dealsTo->setTeamTo($this);
        }

        return $this;
    }

    public function removeDealsTo(Deal $dealsTo): self
    {
        if ($this->deals_to->removeElement($dealsTo)) {
            // set the owning side to null (unless already changed)
            if ($dealsTo->getTeamTo() === $this) {
                $dealsTo->setTeamTo(null);
            }
        }

        return $this;
    }

    public function getTeamManager(): ?TeamManager
    {
        return $this->team_manager;
    }

    public function setTeamManager(TeamManager $team_manager): self
    {
        $this->team_manager = $team_manager;

        return $this;
    }

}
