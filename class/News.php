<?php

class News
{
    protected $id;
    protected $title;
    protected $body;
    protected \DateTime $createdAt;
    protected $comments;

    /**
     * Constructor for initializing properties
     * add constructor to avoid calling the setters
     * removed setter for the use of construct
     */

    public function __construct(
        int $id,
        string $title = "",
        string $body = "",
        \DateTime $createdAt = null,
        $comments = []
    ) { // we can add default value for the columns
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->createdAt = $createdAt ?? new \DateTime();
        $this->comments = $comments ?? [];
    }

    public function getId(): int // add type hinting if int or string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getComments(): array
    {
        return $this->comments;
    }

    public function setComments(array $comments): self
    {
        $this->comments = $comments;
        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}
