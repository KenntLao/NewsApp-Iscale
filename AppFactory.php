<?php

namespace App;

use App\Utils\NewsManager;
use App\Utils\CommentManager;

class AppFactory
{
    public static function createNewsApp()
    {
        $newsManager = NewsManager::getInstance();
        $commentManager = CommentManager::getInstance();
        return new NewsApp($newsManager, $commentManager);
    }
}