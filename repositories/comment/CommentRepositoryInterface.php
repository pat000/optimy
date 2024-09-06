<?php

interface CommentRepositoryInterface
{
    public function addComment(string $body, int $newsId): int;
    public function listComments(): array;
    public function deleteComment(int $id): bool;
}
