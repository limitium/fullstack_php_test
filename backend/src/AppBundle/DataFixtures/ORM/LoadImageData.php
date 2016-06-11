<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Album;
use AppBundle\Entity\Image;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadImageData extends AbstractFixture implements OrderedFixtureInterface
{
    public static $MAX_IMAGES = 123;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::MAX_IMAGES; $i++) {
            $image = new Image();
            $image->setName('Image ' . $i);
            $image->setAlbum($this->getReference('album-' . ($i % LoadAlbumData::$MAX_ALBUMS)));
            $image->setUrl('https://unsplash.it/200/300?image=' . $i);
            $manager->persist($image);
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

        return 2;
    }
}