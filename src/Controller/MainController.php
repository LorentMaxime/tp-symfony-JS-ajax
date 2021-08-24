<?php

namespace App\Controller;

use App\Repository\CouleurRepository;
use App\Repository\FruitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/fruits-couleurs", name="fruits_et_couleurs")
     */
    public function fruitsCouleurs(FruitRepository $repoFruit, CouleurRepository $repoCouleur): Response
    {
        $tabCouleur = [];
        foreach ( $repoCouleur->findAll() as $c )
        {
            $couleur['id'] = $c->getId();
            $couleur['nom'] = $c->getNom();
            $tabCouleur[] = $couleur;
        }

        $tabFruit = [];
        foreach ( $repoFruit->findAll() as $f )
        {
            $fruit['id'] = $f->getId();
            $fruit['nom'] = $f->getNom();
            $fruit['couleur']['id'] = $f->getCouleur()->getId();
            $fruit['couleur']['nom'] = $f->getCouleur()->getNom();
            $tabFruit[] = $fruit;
        }

        $tab['couleurs'] = $tabCouleur;
        $tab['fruits'] = $tabFruit;

        return $this->json($tab);
    }


}
