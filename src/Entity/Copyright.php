<?php

namespace App\Entity;

use App\Repository\CopyrightRepository;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Utils\Traits\EntityTimestampTrait;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CopyrightRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['read:Copyright','read:Entity']],
    denormalizationContext: ['groups' => ['write:Copyright','write:Entity']],
    operations: [
        new Get(
            security: "is_granted('ROLE_ADMIN')"
        ),
        new GetCollection(
            security: "is_granted('ROLE_ADMIN')"
        ),
        new Post(
            validationContext: ['groups' => ['Default']],
            inputFormats: ['multipart' => ['multipart/form-data']],
            security: "is_granted('ROLE_ADMIN')"
        ),
        new Put(
            security: "is_granted('ROLE_ADMIN')"
        ),
        new Patch(
            security: "is_granted('ROLE_ADMIN')"
        ),
        new Delete(
            security: "is_granted('ROLE_ADMIN')"
        )
    ]
)]
class Copyright
{
    use EntityTimestampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $texte = null;

    #[ORM\Column(length: 255)]
    private ?string $mentionLegale = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): static
    {
        $this->texte = $texte;

        return $this;
    }

    public function getMentionLegale(): ?string
    {
        return $this->mentionLegale;
    }

    public function setMentionLegale(string $mentionLegale): static
    {
        $this->mentionLegale = $mentionLegale;

        return $this;
    }
}