<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker\Factory;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{    
    public function __construct(private SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i = 0; $i < 5; $i++) {
            for($p = 1; $p <+ 5; $p++) {
                $program = new Program();
                //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
                $program->setTitle($faker->title());
                $program->setSynopsis($faker->paragraphs(3, true));
                $program->setPoster($faker->imageUrl());
                $program->setCountry($faker->country());
                $program->setYear($faker->year());
                $program->setCategory($this->getReference('category_' . $faker->numberBetween(0, 5), $p));
                $this->addReference('program_', $program);
                $manager->persist($program);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          CategoryFixtures::class,
        ];
    }
}
