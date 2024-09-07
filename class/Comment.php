<?php

class Comment
{
    protected $id;
    protected $body;
    protected $createdAt;
    protected $newsId;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        int $id,
        string $body = "",
        \DateTime $createdAt = null,
        int $newsId = 0,
    ) { // we can add default value for the columns
        $this->id = $id;
        $this->body = $body;
        $this->createdAt = $createdAt ?? new \DateTime();
        $this->newsId = $newsId;
    }

    /**
     * getId
     *
     * @return void
     */
    public function getId(): int
    {
        return $this->id;
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
     * getCreatedAt
     *
     * @return DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * getNewsId
     *
     * @return int
     */
    public function getNewsId(): int
    {
        return $this->newsId;
    }

}
