<?php

/**
 * News
 */
class News
{
    /**
     * id
     *
     * @var mixed
     */
    protected $id;
    /**
     * title
     *
     * @var mixed
     */
    protected $title;
    /**
     * body
     *
     * @var mixed
     */
    protected $body;
    protected \DateTime $createdAt;
    /**
     * comments
     *
     * @var mixed
     */
    protected $comments;


    /**
     * __construct
     *
     * @return void
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

    /**
     * getId
     *
     * @return int
     */
    public function getId(): int // add type hinting if int or string
    {
        return $this->id;
    }

    /**
     * getTitle
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * getBody
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * getComments
     *
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * setComments
     *
     * @param  mixed $comments
     * @return self
     */
    public function setComments(array $comments): self
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * getCreatedAt
     *
     * @return DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}
