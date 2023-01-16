<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setName("User Name");
        $user->setBirthDay(new \DateTime());
        $user->setEmail("user@email.com");
        $user->setPassword("****");
        $manager->persist($user);
        for($i = 1;$i < 10; $i++){
            $post = new Post();
            $post->setTitle("Title".$i);
            $post->setDate(new \DateTime());
            $post->setContent("some text of post");
            $post->setUser($user);
            $manager->persist($post);
        }
        $manager->flush();
    }
}
