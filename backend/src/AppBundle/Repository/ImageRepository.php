<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Album;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * ImageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ImageRepository extends EntityRepository
{
    /**
     * @param Album $album
     * @return QueryBuilder
     */
    public function getImagesByAlbumQuery(Album $album)
    {

        return $this->createQueryBuilder("i")
            ->where("i.album = :album")
            ->setParameter('album', $album);
    }
}
