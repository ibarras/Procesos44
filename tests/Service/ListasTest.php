<?php

namespace App\Test\Service;

use PHPUnit\Framework\TestCase;
use App\Service\IcListas;
use App\Service\IcListasService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ListasTest extends TestCase
{
    public function testSomething()
    {
        $reques = new Request();

        $o = new IcListasService();
        $o->centroOrganizativo();



    }
}
