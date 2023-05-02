<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\NewProduitType;
<<<<<<< HEAD
=======
use App\Repository\ProduitRepository;
>>>>>>> 6c79a856d83b36798ecdb46a0800862c6f24f80c
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


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

<<<<<<< HEAD
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
=======
    #[Route('/new', name: 'produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProduitRepository $produitRepository, SluggerInterface $slugger): Response
    {
        $produit = new Produit();
        // création du formulaire
        $form = $this->createForm(NewProduitType::class, $produit);
        // lecture du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitRepository->save($produit, true);

            $imgProduit = $form['picture']->getData();

        if($imgProduit){
            $originalFilename = pathinfo($imgProduit->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imgProduit->guessExtension();

                try {
                    $imgProduit->move(
                        $this->getParameter('img_product_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $produit->setPicture($newFilename);
            }

            return $this->redirectToRoute('produit', [], Response::HTTP_SEE_OTHER);
            
        }

        return $this->render('produit/new.html.twig', [
                'produit' => $produit,
                'form' => $form->createView(),
>>>>>>> 6c79a856d83b36798ecdb46a0800862c6f24f80c
            ]);
    }
}