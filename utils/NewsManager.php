<?php

class NewsManager
{
    private static $instance = null;
    private $newsRepository;

    /**
     * use repository pattern for more flexible code and can be reusable.
     * we can also service or traits if we want
     */
    /**
     * __construct
     *
     * @param  mixed $newsRepository
     * @return void
     */
    private function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * getInstance
     *
     * @param  mixed $newsRepository
     * @return void
     */
    public static function getInstance(NewsRepositoryInterface $newsRepository)
    {
        if (null === self::$instance) {
            self::$instance = new self($newsRepository);
        }
        return self::$instance;
    }

    /**
     * listNews
     *
     * @return array
     */
    public function listNews(): array
    {
        return $this->newsRepository->listNews();
    }


    /**
     * getNewsWithComments
     *
     * @return array
     */
    public function getNewsWithComments(): array
    {
        return $this->newsRepository->getNewsWithComments();
    }

    /**
    * add a record in news table using repositories
    */
    /**
     * addNews
     *
     * @param  mixed $title
     * @param  mixed $body
     * @return int $lastInsertID
     */
    public function addNews($title, $body): int
    {
        return $this->newsRepository->addNews($title, $body);
    }

    /**
    * deletes a news, and also linked comments
    */
    /**
     * deleteNews
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteNews($id)
    {
        return $this->newsRepository->deleteNews($id);
    }
}
