<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for($i = 0; $i < 5; $i++) {
            $category = new Category();
            //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
            $category->setName($faker->word());
            $this->setReference('category_', $i, $category);
            $manager->persist($category);
        }
        $manager->flush();
    }
}