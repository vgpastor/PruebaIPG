<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Create 50 user
        for ($i = 0; $i < 50; ++$i) {
            $author = new User();
            $author->setName('Author '.$i);
            $author->setAbstract('<p>Abstract '.$i.'</p>');
            $manager->persist($author);
        }
        $manager->flush();

        //Create 100 posts
        for ($i = 0; $i < 100; ++$i) {
            $post = new Post();
            $post->setTitle('Post #'.$i);
            $post->setBody('This is my '.$i.' blog post!');
            $author = $manager->find(User::class, rand(1, 50));
            if (!is_null($author)) {
                $post->setAuthor($author);
            }
            $manager->persist($post);
        }

        $manager->flush();
    }
}
