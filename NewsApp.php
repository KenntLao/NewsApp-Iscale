<?php

namespace App;

use App\Utils\NewsManager;
use App\Utils\CommentManager;

class NewsApp
{
    private $newsManager;
    private $commentManager;
    
    /**
     * __construct
     *
     * @param  mixed $newsManager
     * @param  mixed $commentManager
     * @return void
     */
    public function __construct(NewsManager $newsManager, CommentManager $commentManager)
    {
        $this->newsManager = $newsManager;
        $this->commentManager = $commentManager;
    }

    public function displayNewsWithComments()
    {
        $newsList = $this->newsManager->listNews();
        $comments = $this->commentManager->listComments();
        $commentsByNewsId = $this->groupCommentsByNewsId($comments);

        foreach ($newsList as $news) {
            $this->displayNews($news, $commentsByNewsId[$news->getId()] ?? []);
        }
    }

    private function displayNews($news, $comments)
    {
        echo "############ NEWS " . $news->getTitle() . " ############\n";
        echo $news->getBody() . "\n";

        foreach ($comments as $comment) {
            echo "Comment " . $comment->getId() . " : " . $comment->getBody() . "\n";
        }
    }

    private function groupCommentsByNewsId($comments)
    {
        $commentsByNewsId = [];
        foreach ($comments as $comment) {
            $commentsByNewsId[$comment->getNewsId()][] = $comment;
        }
        return $commentsByNewsId;
    }
}