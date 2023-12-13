<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\FilesRepository;
use App\Service\ConvertValueToBoolService;
use App\Utils\Traits\EntityTimestampTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity(repositoryClass: FilesRepository::class)]
class Files
{
    use EntityTimestampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'ulid', unique: true)]
    #[ORM\CustomIdGenerator(class: UlidGenerator::class)]
    private ?Ulid $id = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 255)]
    private string $filename;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 255)]
    private string $type;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 255)]
    private string $location;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::INTEGER, length: 11)]
    private int $size = 0;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 255)]
    private string $referenceCode;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::BOOLEAN, options: [
        'default' => false,
    ])]
    private string|bool|null $temp = false;

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getReferenceCode(): ?string
    {
        return $this->referenceCode;
    }

    public function setReferenceCode(string $referenceCode): self
    {
        $this->referenceCode = $referenceCode;

        return $this;
    }

    public function isTemp(): ?bool
    {
        return $this->temp;
    }

    public function setTemp(string|bool|null $temp): self
    {
        $this->temp = ConvertValueToBoolService::convertValueToBool($temp);

        return $this;
    }

    public function getId(): ?\Symfony\Component\Uid\Ulid
    {
        return $this->id;
    }
}