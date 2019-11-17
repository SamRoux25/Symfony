<?php

namespace App\Controller;


use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PropertyController extends AbstractController{


    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route ("/biens", name="property.index")
     * @return Response
     */
    public function index():Response
    {
        //appel de ma page  + parametre a envoyer vers twig
        return $this->render('property/index.html.twig', [
            'menu_selectionne' => 'properties'
        ]); //appel de ma page html
    }

    /**
     * @Route ("/biens/{slug}-{id}", name="property.show" , requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show($slug, $id, PropertyRepository $repository):Response{
        $property = $this->repository->find($id); //objet avec le bon bien

        if($property->getSlug() !== $slug){ //dans le cas ou il rentre n'importe quoi dans l'url
           return $this->redirectToRoute('property.show',[
                'id' => $property->getid(),
                'slug' => $property->getSlug()
            ],301);
        }

        return $this->render('property/show.html.twig', [
            'property' => $property,
            'menu_selectionne' => 'properties'
        ]);
    }
}