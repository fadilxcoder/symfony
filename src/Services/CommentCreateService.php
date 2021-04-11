<?php

namespace App\Services;

use App\Entity\Comment;
use Symfony\Component\Security\Core\Security;

class CommentCreateService
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function __invoke(Comment $data): Comment
    {
        $data->setAuthor($this->security->getUser());

        return $data;
    }
}