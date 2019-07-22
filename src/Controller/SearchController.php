<?php

namespace App\Controller;

use App\Form\JobSearchType;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index(Request $request, JobRepository $repository)
    {
        $form = $this->createForm(JobSearchType::class);

        $form->handleRequest($request);

        $searchResult = [];
        if($form->isSubmitted() && $form->isValid()){
            $searchResult = $repository->getJobsFromSearch($form->getData());
        }

        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
            'form'=>$form->createView(),
            'searchResult' => $searchResult
        ]);
    }
}
