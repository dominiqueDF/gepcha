<?php

namespace App\Controller;

use App\Repository\OwnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnimalController extends AbstractController
{
    /**
     * @Route("/animal", name="animal")
     */
    public function index(OwnerRepository $ownerRepository)
    {
        // Récupération des propriétaires
        $owners = $ownerRepository->findAll();

        return $this->render('animal/index.html.twig', [
            'controller_name' => 'AnimalController',
            'owners' => $owners,
        ]);
    }
}
