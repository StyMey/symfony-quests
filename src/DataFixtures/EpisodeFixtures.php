<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $episode = new Episode();
        $episode->setTitle('L\'exil');
        $episode->setNumber(1);
        $episode->setSynopsis('100 mineurs condamnés de divers crimes sont envoyés à la surface.');
        $episode->setSeason($this->getReference('season1_The 100'));
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setTitle('Et si... Captain Carter était devenue le premier Avenger ?');
        $episode->setNumber(1);
        $episode->setSynopsis('Alors que Steve Rogers est blessé, Peggy Carter devient le premier Super Soldat de l\'Histoire.');
        $episode->setSeason($this->getReference('season1_What if...?'));
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setTitle('Chapitre 1: Le Mandalorien');
        $episode->setNumber(1);
        $episode->setSynopsis('Un chasseur de primes mandalorien traque un objectif pour un mystérieux et fortuné client.');
        $episode->setSeason($this->getReference('season1_The Mandalorian'));
        $manager->persist($episode);

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
