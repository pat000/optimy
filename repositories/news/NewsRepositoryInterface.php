<?php

interface NewsRepositoryInterface
{
    public function addNews(string $title, string $body): int;
    public function listNews(): array;
    public function getNewsWithComments(): array;
    public function deleteNews(int $id): bool;
}
