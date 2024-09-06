<?php

require_once(ROOT . '/class/Comment.php');

class CommentRepository implements CommentRepositoryInterface
{
    protected $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

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


    public function addComment(string $body, int $newsId): int
    {
        $db = DB::getInstance();
        $sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) 
                VALUES('" . $body . "','" . date('Y-m-d') . "','" . $newsId . "')";
        $db->exec($sql);
        return $db->lastInsertId($sql);
    }

    public function deleteComment(int $id): bool
    {
        //
        $sql = "DELETE FROM `comment` WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
