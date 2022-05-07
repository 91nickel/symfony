<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    /**
     * @Route("/lucky", name="lucky")
     */
    public function index ()
    {
        return $this->render('lucky/index.html.twig', [
            'controller_name' => 'LuckyController',
        ]);
    }

    /**
     * @Route("/lucky/number/", name="lucky_number")
     */
    public function number ()
    {
        $number = random_int(0, 100);

        return $this->render('lucky/index.html.twig', [
            'controller_name' => 'LuckyController',
            'number' => $number,
        ]);
    }

    /**
     * @Route("/lucky/number/{customNumber}", name="custom_number", requirements={"customNumber"="\d+"})
     * @param string $customNumber
     * @return Response
     * @throws Exception
     */
    public function customNumber (string $customNumber)
    {
        return $this->render('lucky/index.html.twig', [
            'controller_name' => 'LuckyController',
            'number' => $customNumber,
        ]);
    }
}
