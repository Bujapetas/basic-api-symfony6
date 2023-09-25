<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $country1 = new Country();
        $country1->setName('USA');
        $manager->persist($country1);

        $country2 = new Country();
        $country2->setName('Canada');
        $manager->persist($country2);

        $country3 = new Country();
        $country3->setName('Mexico');
        $manager->persist($country3);

        $country4 = new Country();
        $country4->setName('France');
        $manager->persist($country4);

        $country5 = new Country();
        $country5->setName('Germany');
        $manager->persist($country5);

        $country6 = new Country();
        $country6->setName('Italy');
        $manager->persist($country6);

        $country7 = new Country();
        $country7->setName('Spain');
        $manager->persist($country7);

        $manager->flush();

        $this->addReference('country1', $country1);
        $this->addReference('country2', $country2);
        $this->addReference('country3', $country3);
        $this->addReference('country4', $country4);
        $this->addReference('country5', $country5);
        $this->addReference('country6', $country6);
        $this->addReference('country7', $country7);
    }
}
