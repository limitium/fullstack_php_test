<?php

namespace AppBundle\Service;

use AppBundle\Entity\Album;
use AppBundle\Repository\AlbumRepository;
use AppBundle\Repository\ImageRepository;
use Doctrine\ORM\EntityRepository;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Knp\Component\Pager\Paginator;

/**
 * Class GalleryService
 * @package AppBundle\Service
 */
class GalleryService
{
    private $albumRepository;
    private $imageRepository;
    private $paginator;

    /**
     * GalleryService constructor.
     * @param AlbumRepository $albumRepository
     * @param ImageRepository $imageRepository
     * @param Paginator $paginator
     */
    public function __construct(AlbumRepository $albumRepository, ImageRepository $imageRepository, Paginator $paginator)
    {
        $this->albumRepository = $albumRepository;
        $this->imageRepository = $imageRepository;
        $this->paginator = $paginator;
    }

    /**
     * @return array
     */
    public function getAllAlbumsWithImages():array
    {

        return $this->albumRepository->getAllAlbumsWithImages();
    }

    /**
     * @param Album $album
     * @param int $page
     * @param int $limit
     * @return SlidingPagination
     */
    public function getPaginatedImagesByAlbum(Album $album, int $page = 1, int $limit = 10):SlidingPagination
    {

        return $this->paginator->paginate(
            $this->imageRepository->getImagesByAlbumQuery($album),
            $page,
            $limit
        );
    }
}
