<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\NewProduitType;
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

    #[Route('/produit/new', name: 'new.produit')]
    public function new(Request $request): Response

    {
    $produit = new Produit();
    // création du formulaire
    $form = $this->createForm(NewProduitType::class, $produit);
    // lecture du formulaire
    // $form->handleRequest($request);
    return $this->renderForm('produit/new.html.twig', [
        'form' => $form,
            ]);
    }
}