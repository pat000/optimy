<?php

class CommentManager
{
    private static $instance = null;
    private $commentRepository;

    private function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public static function getInstance(CommentRepositoryInterface $commentRepository)
    {
        if (null === self::$instance) {
            self::$instance = new self($commentRepository);
        }
        return self::$instance;
    }

    /**
     * list add comments
     */

    public function listComments()
    {
        return $this->commentRepository->listComments();
    }

    /**
     * add comments by news
     */
    public function addCommentForNews($body, $newsId)
    {
        return $this->commentRepository->addComment($body, $newsId);
    }

    /**
     * delete specific comment
     */
    public function deleteComment($id)
    {
        return $this->commentRepository->deleteComment($id);
    }
}
