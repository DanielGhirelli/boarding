<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OmnifundApplicationsDocsRepository")
 */
class OmnifundApplicationsDocs
{
    /**
     * @Groups("api:read")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=50)
     */
    private $category;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=30)
     */
    private $type;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="integer")
     */
    private $size;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * string
     */
    private $temporaryUrl;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OmnifundApplications", inversedBy="applicationDocs")
     * @ORM\JoinColumn(name="application_id", referencedColumnName="application_id", nullable=false)
     */
    private $application;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now', new \DateTimeZone('UTC'));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getTemporaryUrl(): ?string
    {
        return $this->temporaryUrl;
    }

    public function setTemporaryUrl(string $temporaryUrl): void
    {
        $this->temporaryUrl = $temporaryUrl;
    }

    public function getApplication(): ?OmnifundApplications
    {
        return $this->application;
    }

    public function setApplication(?OmnifundApplications $application): self
    {
        $this->application = $application;

        return $this;
    }
}
