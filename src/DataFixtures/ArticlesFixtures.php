<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    //     $faker = \Faker\Factory::create('fr_FR');

    //     for ($i=0; $i<=10; $i++){
    //         $article = new Article;
    //         $content = '<p>'.join($faker->paragraphs(5), '</p><p>').'<p>';
    //         $article->setTitle($faker->sentence())->setContent($content)->setImage($faker->imageUrl())->setCreatedAt(new \DateTime());
    //         $manager->persist($article);
    //     }
    //     $manager->flush();
     }
}
