<?php


namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

    
class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {           
            
        $faker = Factory::create('fr_FR'); 

        for($j = 1; $j <= mt_rand(4, 6); $j++){


        $article = new Article();

        $content = '<p>' . join($faker->paragraphs(5), '</p><p>') . '</p>';

        $article->setTitle($faker->sentence())
                ->setContent($content)        
                ->setImage($faker->imageUrl())
                ->setCreatedAt($faker->dateTimeBetween(' -6 months' ));


                $manager->persist($article);

       
    }
    $manager->flush();    
}

}
