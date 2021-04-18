<?php

namespace App\Services;

use App\Entity\Comment;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Security;

class CommentCreateService
{
    private $security, $userRepository;

    public function __construct(
        Security $security,
        UserRepository $userRepository
    ) {
        $this->security = $security;
        $this->userRepository = $userRepository;
    }

    public function __invoke(Comment $data): Comment
    {
        $total_user = $this->userRepository->findAll();
        $random_user = rand(1, count($total_user));
        $user = $total_user[$random_user];
        
        // $data->setAuthor($this->security->getUser());
        $data->setAuthor($user);

        return $data;
    }
}