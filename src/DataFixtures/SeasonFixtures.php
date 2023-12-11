<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $season = new Season();
        $season->setNumber(1);
        $season->setDescription('97 années après une guerre nucléaire qui a dévasté la surface de la Terre');
        $season->setYear(2014);
        $season->setProgram($this->getReference('program_The 100'));
        $this->addReference('season1_The 100', $season);
        $manager->persist($season);

        $season = new Season();
        $season->setNumber(1);
        $season->setDescription('Et si les choses s\'était passé différement pour les héros Marvel ?');
        $season->setYear(2021);
        $season->setProgram($this->getReference('program_What if...?'));
        $this->addReference('season1_What if...?', $season);
        $manager->persist($season);

        $season = new Season();
        $season->setNumber(1);
        $season->setDescription('Un chasseur de primes solitaire faisant une rencontre qui va changer sa vie dans les contrées les plus éloignées de la Galaxie');
        $season->setYear(2019);
        $season->setProgram($this->getReference('program_The Mandalorian'));
        $this->addReference('season1_The Mandalorian', $season);
        $manager->persist($season);

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          ProgramFixtures::class,
        ];
    }
}
