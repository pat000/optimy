<?php

class CommentManager
{
    private static $instance = null;
    private $commentRepository;

    /**
     * __construct
     *
     * @param  mixed $commentRepository
     * @return void
     */
    private function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * getInstance
     *
     * @param  mixed $commentRepository
     * @return void
     */
    public static function getInstance(CommentRepositoryInterface $commentRepository)
    {
        if (null === self::$instance) {
            self::$instance = new self($commentRepository);
        }
        return self::$instance;
    }

    /**
     * listComments
     *
     * @return void
     */
    public function listComments()
    {
        return $this->commentRepository->listComments();
    }

    /**
     * addCommentForNews
     *
     * @param  mixed $body
     * @param  mixed $newsId
     * @return void
     */
    public function addCommentForNews($body, $newsId)
    {
        return $this->commentRepository->addComment($body, $newsId);
    }


    /**
     * deleteComment
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteComment($id)
    {
        return $this->commentRepository->deleteComment($id);
    }
}
