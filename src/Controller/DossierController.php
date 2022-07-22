<?php

namespace App\Controller;

use App\Entity\Dossier;
use App\Entity\Produit;
use App\Form\DossierType;
use App\Form\ProduitType;
use App\Repository\DossierRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/dossier')]
class DossierController extends AbstractController
{
    #[Route('/', name: 'app_dossier_index', methods: ['GET'])]
    public function index(DossierRepository $dossierRepository): Response
    {
        return $this->render('dossier/index.html.twig', [
            'dossiers' => $dossierRepository->findBy([],['daterdv' => 'ASC']),
        ]);
    }

    #[Route('/encours', name: 'dossier_encours', methods: ['GET'])]
    public function dossier_encours(DossierRepository $dossierRepository): Response
    {
        return $this->render('dossier/dossierencours.html.twig', [
            'dossiers' => $dossierRepository->findBy(['status' => 1],['daterdv' => 'ASC']),
        ]);
    }

    #[Route('/livrer', name: 'dossier_livrer', methods: ['GET'])]
    public function dossier_livrer(DossierRepository $dossierRepository): Response
    {

        return $this->render('dossier/dossierlivre.html.twig', [
            'dossiers' => $dossierRepository->findBy(['status' => 3], ['daterdv' => 'DESC']),
        ]);
    }

    #[Route('/terminer/{id}', name: 'dossier_terminer', methods: ['GET'])]
    public function dossier_terminer(Request $request,Dossier $dossier, EntityManagerInterface $entityManager): Response
    {
        $dossier->setStatus(3);
        $entityManager->flush();
        return $this->redirectToRoute("dossier_encours", [], Response::HTTP_SEE_OTHER);

        // $referer = $_SERVER['HTTP_REFERER'];
        // return $this->redirect($referer);
    }

    #[Route('/retour/{id}', name: 'dossier_retour', methods: ['GET'])]
    public function dossier_retourn(Request $request,Dossier $dossier, EntityManagerInterface $entityManager): Response
    {
        $dossier->setStatus(1);
        $entityManager->flush();
        return $this->redirectToRoute("dossier_encours", [], Response::HTTP_SEE_OTHER);

        // $referer = $_SERVER['HTTP_REFERER'];
        // return $this->redirect($referer);
    }



    #[Route('/new', name: 'app_dossier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DossierRepository $dossierRepository): Response
    {
        $dossier = new Dossier();
    

        $form = $this->createForm(DossierType::class, $dossier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());
            $dossier->setStatus(1);
            $dossierRepository->add($dossier, true);

            return $this->redirectToRoute('app_dossier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dossier/new.html.twig', [
            'dossier' => $dossier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dossier_show', methods: ['GET'])]
    public function show(Dossier $dossier): Response
    {
        $tt_cout_piece=0;
        $tt_prix=0;
        foreach($dossier->getProduits() as $item )
        {
            $tt_cout_piece = $tt_cout_piece+$item->getCoutPiece();
            $tt_prix = $tt_prix+$item->getPrix();
        }

        return $this->render('dossier/show.html.twig', [
            'dossier' => $dossier,
            'tt_cout_piece' => $tt_cout_piece,
            'tt_prix' => $tt_prix,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dossier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dossier $dossier, DossierRepository $dossierRepository): Response
    {
        $form = $this->createForm(DossierType::class, $dossier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dossierRepository->add($dossier, true);

            return $this->redirectToRoute('app_dossier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dossier/edit.html.twig', [
            'dossier' => $dossier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dossier_delete', methods: ['POST'])]
    public function delete(Request $request, Dossier $dossier, DossierRepository $dossierRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dossier->getId(), $request->request->get('_token'))) {
            $dossierRepository->remove($dossier, true);
        }

        return $this->redirectToRoute('app_dossier_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('produit/{id}', name: 'dossier_produit_delete', methods: ['POST'])]
    public function produitdelete(Request $request, Produit $produit, ProduitRepository $produitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $produitRepository->remove($produit, true);
        }

        return $this->redirectToRoute('app_dossier_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/newproduit', name: 'dossier_new_produit', methods: ['GET'])]
    public function dossier_new_produit(Request $request, Dossier $dossier): Reponse
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $produit->setDossier($dossier);
            $produitRepository->add($produit, true);

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

}
