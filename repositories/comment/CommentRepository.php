<?php

require_once ROOT . '/class/Comment.php';

class CommentRepository implements CommentRepositoryInterface
{
    protected $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    /**
     * listComments
     *
     * @return array
     */
    public function listComments(): array
    {
        $sql = "SELECT * FROM `comment`";
        $rows = $this->db->select($sql);

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


    /**
     * addComment
     *
     * @param  mixed $body
     * @param  mixed $newsId
     * @return int
     */
    public function addComment(string $body, int $newsId): int
    {
        $sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) 
                VALUES(:body,:created_at,:news_id)";
        $stmt = $this->db->prepare($sql);

        $createdAt = date('Y-m-d');

        // bind parameters to avoid SQL injection
        $stmt->bindParam(':body', $body);
        $stmt->bindParam(':created_at', $createdAt);
        $stmt->bindParam(':news_id', $newsId);

        $stmt->execute();
        return $this->db->lastInsertId();
    }

    /**
     * deleteComment
     *
     * @param  mixed $id
     * @return bool
     */
    public function deleteComment(int $id): bool
    {
        //
        $sql = "DELETE FROM `comment` WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
