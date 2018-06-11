<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\Employee;

class ResultController extends Controller
{
    /**
     * Find all results of a single employee
     *
     * @Rest\View()
     * @Rest\Get("/employees/{id}/results")
     */
    public function getEmployeeResultsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $employee = $em->getRepository(Employee::class)->find($request->get('id'));

        if (empty($employee)) {
            return new JsonResponse(['message' => 'Employee not found'], Response::HTTP_NOT_FOUND);
        }

        return $employee->getResults();
    }
}
