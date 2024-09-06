<?php

class NewsManager
{
    private static $instance = null;
    private $newsRepository;

    /**
     * use repository pattern for more flexible code and can be reusable.
     * we can also service or traits if we want
     */
    private function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public static function getInstance(NewsRepositoryInterface $newsRepository)
    {
        if (null === self::$instance) {
            self::$instance = new self($newsRepository);
        }
        return self::$instance;
    }

    /**
    * list all news
    */
    public function listNews()
    {
        return $this->newsRepository->listNews();
    }

    /**
     * list all news with comments
     */
    public function getNewsWithComments()
    {
        return $this->newsRepository->getNewsWithComments();
    }

    /**
    * add a record in news table using repositories
    */
    public function addNews($title, $body)
    {
        return $this->newsRepository->addNews($title, $body);
    }

    /**
    * deletes a news, and also linked comments
    */
    public function deleteNews($id)
    {
        return $this->newsRepository->deleteNews($id);
    }
}
