<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie1 = new Movie();
        $movie1->setTitle('The Shawshank Redemption');
        $movie1->setGenre($this->getReference('genre1'));
        $movie1->setContry($this->getReference('country1'));
        $movie1->setBudget(25000000);
        $movie1->setReleaseDate(new \DateTime('1994-10-14'));
        $movie1->setDescription("Andy Dufresne (Tim Robbins) is sentenced to two consecutive life terms in prison for the murders of his wife and her lover and is sentenced to a tough prison. However, only Andy knows he didn't commit the crimes. While there, he forms a friendship with Red (Morgan Freeman), experiences brutality of prison life, adapts, helps the warden, etc., all in 19 years.");
        $movie1->setPoster('https://image.tmdb.org/t/p/w500/q6y0Go1tsGEsmtFryDOJo3dEmqu.jpg');
        $movie1->setRuntime(142);
        $manager->persist($movie1);

        $movie2 = new Movie();
        $movie2->setTitle('The Godfather');
        $movie2->setGenre($this->getReference('genre1'));
        $movie2->setContry($this->getReference('country1'));
        $movie2->setBudget(6000000);
        $movie2->setReleaseDate(new \DateTime('1972-03-24'));
        $movie2->setDescription("The story begins as Don Vito Corleone, the head of a New York Mafia family, oversees his daughter's wedding. His beloved son Michael has just come home from the war, but does not intend to become part of his father's business. Through Michael's life the nature of the family business becomes clear. The business of the family is just like the head of the family, kind and benevolent to those who give respect, but given to ruthless violence whenever anything stands against the good of the family.");
        $movie2->setPoster('https://image.tmdb.org/t/p/w500/3bhkrj58Vtu7enYsRolD1fZdja1.jpg');
        $movie2->setRuntime(175);
        $manager->persist($movie2);

        $movie3 = new Movie();
        $movie3->setTitle('The Godfather: Part II');
        $movie3->setGenre($this->getReference('genre1'));
        $movie3->setContry($this->getReference('country1'));
        $movie3->setBudget(13000000);
        $movie3->setReleaseDate(new \DateTime('1974-12-20'));
        $movie3->setDescription("The continuing saga of the Corleone crime family tells the story of a young Vito Corleone growing up in Sicily and in 1910s New York; and follows Michael Corleone in the 1950s as he attempts to expand the family business into Las Vegas, Hollywood and Cuba.");
        $movie3->setPoster('https://image.tmdb.org/t/p/w500/bVq65huQ8vHDd1a4Z37QtuyEvpA.jpg');
        $movie3->setRuntime(202);
        $manager->persist($movie3);

        $movie4 = new Movie();
        $movie4->setTitle('The Dark Knight');
        $movie4->setGenre($this->getReference('genre1'));
        $movie4->setContry($this->getReference('country1'));
        $movie4->setBudget(185000000);
        $movie4->setReleaseDate(new \DateTime('2008-07-18'));
        $movie4->setDescription("Batman raises the stakes in his war on crime. With the help of Lt. Jim Gordon and District Attorney Harvey Dent, Batman sets out to dismantle the remaining criminal organizations that plague the streets. The partnership proves to be effective, but they soon find themselves prey to a reign of chaos unleashed by a rising criminal mastermind known to the terrified citizens of Gotham as the Joker.");
        $movie4->setPoster('https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg');
        $movie4->setRuntime(152);
        $manager->persist($movie4);

        $manager->flush();
    }
}
