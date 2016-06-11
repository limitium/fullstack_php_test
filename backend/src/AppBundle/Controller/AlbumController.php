<?php

namespace AppBundle\Controller;


use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\DiExtraBundle\Annotation as DI;

use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\GalleryService;
use AppBundle\Entity\Album;

/**
 * Album controller.
 *
 */
class AlbumController extends Controller
{
    /**
     * @DI\Inject("app.gallery")
     * @var GalleryService $galleryService
     */
    private $galleryService;

    /**
     * @Rest\Get("/albums")
     * @Rest\View()
     */
    public function getAlbumsAction()
    {

        return $this->galleryService->getAllAlbumsWithImages();
    }

    /**
     * @Rest\Get("/album/{album}")
     * @Rest\View()
     * @param Album $album
     * @return SlidingPagination
     */
    public function getAlbumAction(Album $album)
    {

        return $this->galleryService->getPaginatedImagesByAlbum($album);
    }

    /**
     * @Rest\Get(
     *     "/album/{album}/page/{page}",
     *     requirements={
     *         "page": "\d+"
     *     }
     * )
     * @Rest\View()
     * @param Album $album
     * @param $page
     * @return SlidingPagination
     */
    public function getAlbumPageAction(Album $album, int $page)
    {

        return $this->galleryService->getPaginatedImagesByAlbum($album, $page);
    }
}
