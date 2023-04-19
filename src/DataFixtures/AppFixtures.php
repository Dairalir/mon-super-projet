<?php

namespace App\DataFixtures;

use App\Entity\Rubrique;
use App\Entity\SousRubrique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $rub1 = new Rubrique();
        $rub1->setName('Groupes');
    
        $manager->persist($rub1);

        $srub1 = new SousRubrique;
        $srub1->setName('Dreamcatcher');
        $srub1->setPicture('dreamcatcherlogo.jpeg');

        $srub1->setRubrique($rub1);

        $manager->persist($srub1);



        $manager->flush();
    }
}
