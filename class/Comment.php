<?php

class Comment
{
    protected $id;
    protected $body;
    protected $createdAt;
    protected $newsId;

    /**
     * setId
     *
     * @param  mixed $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * getId
     *
     * @return void
     */
    public function getId()
    {
        return $this->id;
    }
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getNewsId()
    {
        return $this->newsId;
    }

    public function setNewsId($newsId)
    {
        $this->newsId = $newsId;

        return $this;
    }
}
