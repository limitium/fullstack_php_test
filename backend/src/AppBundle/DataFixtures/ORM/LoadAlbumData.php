<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Album;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAlbumData extends AbstractFixture implements OrderedFixtureInterface
{
    public static $MAX_ALBUMS = 5;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::$MAX_ALBUMS; $i++) {
            $album = new Album();
            $album->setName('Album ' . $i);
            $manager->persist($album);

            $this->addReference('album-' . $i, $album);
        }
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {

        return 1;
    }
}