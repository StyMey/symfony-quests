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
            for($p = 1; $p < 5; $p++) {
                for($s = 1; $s < 5; $s++) {
                    for($e = 1; $e < 10; $e++) {
                        $episode = new Episode();
                        //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
                        $episode->setNumber($faker->numberBetween(1, 10));
                        $episode->setTitle($faker->title());
                        $episode->setSynopsis($faker->paragraphs(3, true));
                        $episode->setSeason($this->getReference('season_' . $p . $e . $i));

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
