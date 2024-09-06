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
        require_once(ROOT . '/utils/DB.php');
        require_once(ROOT . '/utils/CommentManager.php');
        require_once(ROOT . '/class/News.php');

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
        // instantiate get all news
        $rows = $this->newsRepository->listNews();

        $news = [];
        foreach ($rows as $row) {
            // make it DRY - no more other variables and set readable variable
            $news[] = new News(
                $row['id'],
                $row['title'],
                $row['body'],
                new \DateTime($row['created_at'])
            );
        }

        return $news;
    }

    public function getNewsWithComments()
    {
        $rows = $this->newsRepository->getNewsWithComments();

        $newsWithComments = [];

        foreach ($rows as $row) {
            // make it DRY - no more other variables and set readable variable
            $news = new News(
                $row['news_id'],
                $row['news_title'],
                $row['news_body'],
                new \DateTime($row['news_created_at']),
            );

            $comments = [];
            if ($row['comments']) {
                $commentsData = explode('|', $row['comments']);
                foreach ($commentsData as $commentData) {
                    list($commentId, $commentBody) = explode(':', $commentData);
                    $comments[] = [
                        'id' => $commentId,
                        'body' => $commentBody
                    ];
                }
            }
            $news->setComments($comments);

            $newsWithComments[$row['news_id']] = $news;

        }

        return $newsWithComments;

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
