<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\Company;

class ResultController extends Controller
{
    /**
     * Find all results of a single company
     *
     * @Rest\View()
     * @Rest\Get("/companies/{id}/results")
     */
    public function getCompanyResultsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository(Company::class)->find($request->get('id'));

        if (empty($company)) {
            return new JsonResponse(['message' => 'Company not found'], Response::HTTP_NOT_FOUND);
        }

        return $company->getResults();
    }
}
