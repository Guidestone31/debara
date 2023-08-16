<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $PaiementId = null;

    #[ORM\Column(length: 255)]
    private ?string $PayerId = null;

    #[ORM\Column(length: 255)]
    private ?string $PayerEmail = null;

    #[ORM\Column]
    private ?float $Amont = null;

    #[ORM\Column(length: 255)]
    private ?string $currency = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $purchasedAt = null;

    #[ORM\Column(length: 255)]
    private ?string $paiementStatus = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Annoucement $Annoucement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaiementId(): ?string
    {
        return $this->PaiementId;
    }

    public function setPaiementId(string $PaiementId): static
    {
        $this->PaiementId = $PaiementId;

        return $this;
    }

    public function getPayerId(): ?string
    {
        return $this->PayerId;
    }

    public function setPayerId(string $PayerId): static
    {
        $this->PayerId = $PayerId;

        return $this;
    }

    public function getPayerEmail(): ?string
    {
        return $this->PayerEmail;
    }

    public function setPayerEmail(string $PayerEmail): static
    {
        $this->PayerEmail = $PayerEmail;

        return $this;
    }

    public function getAmont(): ?float
    {
        return $this->Amont;
    }

    public function setAmont(float $Amont): static
    {
        $this->Amont = $Amont;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getPurchasedAt(): ?\DateTimeInterface
    {
        return $this->purchasedAt;
    }

    public function setPurchasedAt(\DateTimeInterface $purchasedAt): static
    {
        $this->purchasedAt = $purchasedAt;

        return $this;
    }

    public function getPaiementStatus(): ?string
    {
        return $this->paiementStatus;
    }

    public function setPaiementStatus(string $paiementStatus): static
    {
        $this->paiementStatus = $paiementStatus;

        return $this;
    }

    public function getAnnoucement(): ?Annoucement
    {
        return $this->Annoucement;
    }

    public function setAnnoucement(?Annoucement $Annoucement): static
    {
        $this->Annoucement = $Annoucement;

        return $this;
    }
}
