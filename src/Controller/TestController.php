<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_USER")]
class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        $name = 'toto';
        $age = 40;
        $hobbies = ['chill', 'plage', 'dev'];
        $now = new \DateTime();

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'name' => $name,
            'age' => $age,
            'hobbies' => $hobbies,
            'now' => $now
        ]);
    }
    
    #[Route('/bidulle', name: 'app_bidulle')]
    public function truc(): Response
    {
        return $this->render('test/bidulle.html.twig', [
            'method' => 'Truc from Bidulle route'
        ]);
    }
}
