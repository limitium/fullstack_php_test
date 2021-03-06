<?php

namespace AppBundle\Controller;


use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\DiExtraBundle\Annotation as DI;

use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Album;
use AppBundle\Service\GalleryService;
use AppBundle\Response\PaginatedAlbum;

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
     * @Rest\View(serializerGroups={"album_list"})
     */
    public function getAlbumsAction()
    {

        return $this->galleryService->getAllAlbumsWithImages();
    }

    /**
     * @Rest\Get(
     *     "/album/{album}/page/{page}",
     *     requirements={
     *         "page": "\d+"
     *     }
     * )
     * @Rest\View(serializerGroups={"album_page"})
     * @param Album $album
     * @param $page
     * @return SlidingPagination
     */
    public function getAlbumPageAction(Album $album, int $page)
    {

        return new PaginatedAlbum($album, $this->galleryService->getPaginatedImagesByAlbum($album, $page));
    }
}
