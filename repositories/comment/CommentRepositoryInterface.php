<?php

interface CommentRepositoryInterface
{
    /**
     * addComment
     *
     * @param  mixed $body
     * @param  mixed $newsId
     * @return int
     */
    public function addComment(string $body, int $newsId): int;

    /**
     * listComments
     *
     * @return array
     */
    public function listComments(): array;

    /**
     * deleteComment
     *
     * @param  mixed $id
     * @return bool
     */
    public function deleteComment(int $id): bool;
}
