<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *    collectionOperations={"get", "post"},
 *     itemOperations={
 *          "get"={
 *              "normalization_context"={"groups"={"task:read", "task:item:get"}},
 *          },
 *          "put"
 *     },
 *     normalizationContext={"groups"={"task:read"}},
 *     denormalizationContext={"groups"={"task:write"}} *
 * )
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 * attributes={
 *          "pagination_items_per_page" = 10,
 *          "formats"={"jsonld", "json", "html"}}
 *     }
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"task:read", "task:write"})
     *
     */
    private $done;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deadline;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"task:read", "task:write"})
     *
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"task:item:get", "task:write"})
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=2,
     *     max=50,
     *     maxMessage="Describe your task in 50 characters or less"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TaskList", inversedBy="tasks")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"task:read", "task:write"})
     */
    private $TaskList;

    /**
     * Task constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDone(): ?bool
    {
        return $this->done;
    }

    public function setDone(bool $done): self
    {
        $this->done = $done;

        return $this;
    }

    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    /**
     * Returns human readable time left to complete
     *
     * @Groups({"task:read", "task:write"})
     */
    public function getTimeLeft(): string
    {
        return Carbon::instance($this->getDeadline())->diffForHumans();;
    }

    public function setDeadline(?\DateTimeInterface $deadline): self
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
    * Returns human readable time past since creation
    *
    * @Groups({"task:read", "task:write"})
    */
    public function getCreatedAtAgo(): string
    {
        return Carbon::instance($this->getCreatedAt())->diffForHumans();;
    }

    public function getTaskList(): ?TaskList
    {
        return $this->TaskList;
    }

    public function setTaskList(?TaskList $TaskList): self
    {
        $this->TaskList = $TaskList;

        return $this;
    }
}
