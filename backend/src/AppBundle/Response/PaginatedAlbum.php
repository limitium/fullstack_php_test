<?php

namespace AppBundle\Response;

use AppBundle\Entity\Album;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;

/**
 * Class PaginatedAlbum used for combined response
 */
class PaginatedAlbum
{
    private $album;
    private $paginator;

    /**
     * PaginatedAlbum constructor.
     * @param Album $album
     * @param SlidingPagination $pagination
     */
    public function __construct(Album $album, SlidingPagination $pagination)
    {
        $this->album = $album;
        $this->paginator = $pagination;
        $this->album->setImages(new ArrayCollection($pagination->getItems()));
    }
}