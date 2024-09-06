<?php

require_once(ROOT . '/utils/DB.php');
require_once(ROOT . '/utils/NewsManager.php');
require_once(ROOT . '/repositories/news/NewsRepositoryInterface.php');
require_once(ROOT . '/repositories/news/NewsRepository.php');

require_once(ROOT . '/utils/CommentManager.php');
require_once(ROOT . '/repositories/comment/CommentRepositoryInterface.php');
require_once(ROOT . '/repositories/comment/CommentRepository.php');


// instantiate the repository
$newsRepository = new NewsRepository();
$commentRepository = new CommentRepository();

// use the repository to get the data instance
$newsManager = NewsManager::getInstance($newsRepository);
$commentManager = CommentManager::getInstance($commentRepository);
