<?php

define('ROOT', __DIR__);

require_once(ROOT . '/utils/autoload.php');

// we set this as variable so we can call it again
$newsWithComments = $newsManager->getNewsWithComments(); // created news with joined comments
$plainNews = $newsManager->listNews(); // created also for news only

foreach ($newsWithComments as $news) {
    echo("############ NEWS " . $news->getTitle() . " ############\n");
    echo($news->getBody() . "\n");

    foreach ($news->getComments() as $comment) {
        echo("Comment " . $comment['id'] . " : " . $comment['body'] . "\n");
    }
}


echo "\n\n\n-----------------------Test add and delete---------\n\n";
// test for adding news
$newsId = $newsManager->addNews('ererer', 'sfsdfsf');
echo $newsId;

$addComment = $commentManager->addCommentForNews("sdsdsdsds", $newsId);

// test for deleting newly added news
$delete = $newsManager->deleteNews($newsId);
