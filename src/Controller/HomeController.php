<?php
namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; //permet d'eviter de faire new reponse ($this->twig->render)
use Symfony\Component\HttpFoundation\Response;


class HomeController extends AbstractController {


    /**
     * Permet de recupere des biens et de les envoyers à twig
     * @param PropertyRepository $repository
     * @return Response
     */
    public function index(PropertyRepository $repository):Response{
        $properties= $repository->findLatest();
        return $this->render('pages/home.html.twig', [
            'properties' => $properties
        ]);
    }
}