<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\BlogPost;

class BlogFixtures extends Fixture
{
    private const QTY = 12;

    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=self::QTY; $i++):
            $blog = new BlogPost();
            $blog->setTitle('Title ' . $i);
            $blog->setPublished(new \DateTime('now'));
            $blog->setContent('This is the content for title ' . $i);
            $blog->setAuthor('ghost-rider');

            $manager->persist($blog);
        endfor;

        $manager->flush();
    }
}