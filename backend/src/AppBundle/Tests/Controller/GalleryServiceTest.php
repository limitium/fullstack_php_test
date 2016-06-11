<?php

namespace AppBundle\Service;

use AppBundle\Entity\Album;
use AppBundle\Entity\Image;
use AppBundle\Repository\AlbumRepository;
use AppBundle\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class GalleryServiceTest extends KernelTestCase
{
    public function testPaginatedImages()
    {
        $images = [];
        for ($i = 0; $i < 25; $i++) {
            $image = $this->getMock(Image::class);
            $images [] = $image;
        }

        $imageRepository = $this
            ->getMockBuilder(ImageRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $imageRepository->expects($this->once())
            ->method('getImagesByAlbumQuery')
            ->will($this->returnValue($images));

        $albumRepository = $this
            ->getMockBuilder(AlbumRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        static::bootKernel();

        $galleryService = new GalleryService($albumRepository, $imageRepository, static::$kernel->getContainer()->get('knp_paginator'));
        $slidingPagination = $galleryService->getPaginatedImagesByAlbum(new Album());
        $paginationData = $slidingPagination->getPaginationData();
        
        $this->assertEquals(10, $paginationData['currentItemCount'], "Wrong paginated image number");
        $this->assertEquals(25, $paginationData['totalCount'], "Wrong total image number");
    }
}
