<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i = 0; $i < 5; $i++) {
            for($p = 0; $p < 5; $p++) {
                for($s = 0; $s < 25; $s++) {
                    for($e = 0; $e < 50; $e++) {
                        $episode = new Episode();
                        //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
                        $episode->setNumber($faker->numberBetween(1, 10));
                        $episode->setTitle($faker->title());
                        $episode->setSynopsis($faker->paragraphs(3, true));
                        $episode->setSeason($this->getReference('program_' . $faker->numberBetween(0, 25), $e));

                        $manager->persist($episode);
                    }
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          SeasonFixtures::class,
        ];
    }
}
