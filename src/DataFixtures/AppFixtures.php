<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\BlogPost;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private const BLOG_POST = 12;

    private const COMMENT = 18;

    private const USER = 5;

    private const USER_REF = 'user_fixtures_';

    private const BLOG_REF = 'blogpost_fixtures_';

    private const PASSWORD = 'admin';

    private $faker;

    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher,
    ) {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
        $this->loadBlogPost($manager);
        $this->loadComments($manager);
    }

    private function loadBlogPost(ObjectManager $manager): void
    {
        for ($i=1; $i<=self::BLOG_POST; $i++):
            $uid = random_int(1, self::USER);
            $user = $this->getReference(self::USER_REF . $uid);
            $blog = new BlogPost();
            $blog->setTitle($this->faker->sentence());
            $blog->setPublished($this->faker->dateTime('now'));
            $blog->setContent($this->faker->text());
            $blog->setSlug($this->faker->uuid());
            $blog->setAuthor($user);
            $this->addReference(self::BLOG_REF . $i, $blog);
            $manager->persist($blog);
        endfor;

        $manager->flush();
    }

    private function loadComments(ObjectManager $manager): void
    {
        for ($i=1; $i<=self::COMMENT; $i++):
            $uid = random_int(1, self::USER);
            $user = $this->getReference(self::USER_REF . $uid);

            $bid = random_int(1, self::BLOG_POST);
            $blogpost = $this->getReference(self::BLOG_REF . $bid);

            $comment = new Comment();
            $comment->setContent($this->faker->paragraph(2));
            $comment->setPublished($this->faker->dateTime('now'));
            $comment->setAuthor($user);
            $comment->setBlogpost($blogpost);
            $manager->persist($comment);
        endfor;

        $manager->flush();
    }

    private function loadUsers(ObjectManager $manager): void
    {
        for ($i=1; $i<=self::USER; $i++):
            $user = new User();
            $user->setUsername($this->faker->iban());
            $user->setEmail($this->faker->email());
            $user->setName($this->faker->name);
            $user->setPassword($this->userPasswordHasher->hashPassword($user, self::PASSWORD));
            $this->addReference(self::USER_REF . $i, $user);
            $manager->persist($user);
        endfor;

        $manager->flush();
    }
}