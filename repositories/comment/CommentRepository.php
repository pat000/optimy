<?php

require_once(ROOT . '/utils/DB.php');

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
        return $this->db->select($sql);
    }


    public function addComment(string $body, int $newsId): int
    {
        $db = DB::getInstance();
        $sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES('". $body . "','" . date('Y-m-d') . "','" . $newsId . "')";
        $db->exec($sql);
        return $db->lastInsertId($sql);
    }

    public function deleteComment(int $id): bool
    {
        //
    }

}
