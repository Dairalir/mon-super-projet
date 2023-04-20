<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'produit')]
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }

    public function new(Request $request): Response

    {
    $produit = new Produit();
    // création du formulaire
    $form = $this->createForm(ProductsType::class, $produit);
    // lecture du formulaire
    $form->handleRequest($request);
    return $this->render('produit/new.html.twig', [
                'produit' => $produit,
                'form' => $form->createView(),
            ]);
    }
}