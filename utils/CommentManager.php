<?php

class CommentManager
{
    private static $instance = null;
    private $commentRepository;

    private function __construct(CommentRepositoryInterface $commentRepository)
    {
        require_once(ROOT . '/utils/DB.php');
        require_once(ROOT . '/class/Comment.php');
        $this->commentRepository = $commentRepository;
    }

    public static function getInstance(CommentRepositoryInterface $commentRepository)
    {
        if (null === self::$instance) {
            self::$instance = new self($commentRepository);
        }
        return self::$instance;
    }

    public function listComments()
    {
        $db = DB::getInstance();
        $rows = $db->select('SELECT * FROM `comment`');

        $comments = [];
        foreach ($rows as $row) {
            $n = new Comment();
            $comments[] = $n->setId($row['id'])
              ->setBody($row['body'])
              ->setCreatedAt($row['created_at'])
              ->setNewsId($row['news_id']);
        }

        return $comments;
    }

    public function addCommentForNews($body, $newsId)
    {
        return $this->commentRepository->addComment($body, $newsId);
    }

    public function deleteComment($id)
    {
        $db = DB::getInstance();
        $sql = "DELETE FROM `comment` WHERE `id`=" . $id;
        return $db->exec($sql);
    }
}
