<?php

interface NewsRepositoryInterface
{
    /**
     * addNews
     *
     * @param  mixed $title
     * @param  mixed $body
     * @return int
     */
    public function addNews(string $title, string $body): int;

    /**
     * listNews
     *
     * @return array
     */
    public function listNews(): array;

    /**
     * getNewsWithComments
     *
     * @return array
     */
    public function getNewsWithComments(): array;

    /**
     * deleteNews
     *
     * @param  mixed $id
     * @return bool
     */
    public function deleteNews(int $id): bool;
}
