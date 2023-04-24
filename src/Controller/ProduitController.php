<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\NewProduitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/produit')]
class ProduitController extends AbstractController
{
    #[Route('/', name: 'produit')]
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }

    #[Route('/new', name: 'produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response

    {
    $produit = new Produit();
    // création du formulaire
    $form = $this->createForm(NewProduitType::class, $produit);
    // lecture du formulaire
    $form->handleRequest($request);
    return $this->render('produit/new.html.twig', [
                'produit' => $produit,
                'form' => $form->createView(),
            ]);
    }
}