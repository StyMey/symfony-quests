<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $program = new Program();
        $program->setTitle('Walking dead');
        $program->setSynopsis('Des zombies envahissent la terre');
        $program->setCategory($this->getReference('category_Action'));
        $program->setPoster('ttt');
        $manager->persist($program);

        $program = new Program();
        $program->setTitle('The 100');
        $program->setSynopsis('97 années après une guerre nucléaire qui a dévasté la surface de la Terre');
        $program->setCategory($this->getReference('category_Aventure'));
        $program->setPoster('ttt');
        $manager->persist($program);

        $program = new Program();
        $program->setTitle('What if...?');
        $program->setSynopsis('Et si les choses s\'était passé différement pour les héros Marvel ?');
        $program->setCategory($this->getReference('category_Animation'));
        $program->setPoster('ttt');
        $manager->persist($program);

        $program = new Program();
        $program->setTitle('The Mandalorian');
        $program->setSynopsis('Un chasseur de primes solitaire faisant une rencontre qui va changer sa vie dans les contrées les plus éloignées de la Galaxie');
        $program->setCategory($this->getReference('category_Fantastique'));
        $program->setPoster('ttt');
        $manager->persist($program);

        $program = new Program();
        $program->setTitle('American Horror Story');
        $program->setSynopsis('Des récits à la fois poignants et cauchemardesques, mêlant la peur, le gore et le politiquement correct');
        $program->setCategory($this->getReference('category_Horreur'));
        $program->setPoster('ttt');
        $manager->persist($program);

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
