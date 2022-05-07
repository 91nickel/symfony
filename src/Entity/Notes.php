<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NotesRepository")
 */
class Notes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *  min = 4,
     *  max = 51,
     *  minMessage = "{{ value }} Этого слишком мало, {{limit}} - надо так",
     *  maxMessage = "{{ value }} Этого слишком много, {{limit}}  - надо так"
     * )
     *
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @Assert\NotBlank()
     *
     * @ORM\Column(type="string", length=1200, nullable=true)
     */
    private $description;

    /**
     * @Assert\NotBlank()
     *
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @Assert\NotBlank()
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function getId () : ?int
    {
        return $this->id;
    }

    public function getTitle () : ?string
    {
        return $this->title;
    }

    public function setTitle (string $title) : self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription () : ?string
    {
        return $this->description;
    }

    public function setDescription (?string $description) : self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus () : ?int
    {
        return $this->status;
    }

    public function setStatus (int $status) : self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreated () : ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated (?\DateTimeInterface $created) : self
    {
        $this->created = $created;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
