<?php

require_once(ROOT . '/class/News.php');

class NewsRepository implements NewsRepositoryInterface
{
    protected $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    /**
     * add news with return type as int for lastinsert ID
     */
    public function addNews(string $title, string $body): int
    {
        $sql = "INSERT INTO `news` (`title`, `body`, `created_at`) VALUES(:title, :body, :created_at)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'title' => $title,
            'body' => $body,
            'created_at' => date('Y-m-d')
        ]);

        return $this->db->lastInsertId();
    }

    /**
     *
     */
    public function getNewsWithComments(): array
    {
        $sql = "
             SELECT
                n.id AS news_id,
                n.title AS news_title,
                n.body AS news_body,
                n.created_at AS news_created_at,
                GROUP_CONCAT(
                    CONCAT(c.id, ':', c.body)
                    ORDER BY c.created_at
                    SEPARATOR '|'
                ) AS comments
            FROM
                news n
            LEFT JOIN
                comment c ON n.id = c.news_id
            GROUP BY
                n.id, n.title, n.body, n.created_at
            ORDER BY
                n.id
        ";

        $rows = $this->db->select($sql);

        if ($rows === null) {
            throw new RuntimeException('Database query returned null. Check your database connection and query.');
        }

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

    public function listNews(): array
    {
        $sql = "SELECT * FROM `news`";
        $rows = $this->db->select($sql);

        $news = [];
        foreach ($rows as $row) {
            $news[] = new News(
                $row['id'],
                $row['title'],
                $row['body'],
                new \DateTime($row['created_at'])
            );
        }

        return $news;
    }

    public function deleteNews(int $id): bool
    {
        // delete comments by news id - in laravel we can set by cascade on delete
        $this->deleteCommentsByNewsId($id);

        $sql = "DELETE FROM `news` WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * delete comments by news ID
     */
    protected function deleteCommentsByNewsId($newsId)
    {
        $sql = "DELETE FROM `comment` WHERE `news_id` = :news_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':news_id' => $newsId]);
    }
}
