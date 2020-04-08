<?php

namespace App\Controller;

use App\Service\AlgorithmService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AlgorithmController extends AbstractController
{
    /** @var AlgorithmService */
    private $algorithmService;

    public function __construct(AlgorithmService $algorithmService) {
        $this->algorithmService = $algorithmService;
    }

    /**
     * @Route("/algorithm", name="algorithm")
     */
    public function index(Request $request): array
    {
        $results = [];
        if ($request->isMethod(Request::METHOD_POST)) {
            foreach ($request->request->all() as $number) {
                if (is_numeric($number) && $number >= 1 && $number <= 99999) {
                    $results[$number] = $this->algorithmService->getMaxValueInNumberString($number);
                }
            }
        }

        return $this->render('algorithm/index.html.twig', [
            'results' => $results,
        ]);
    }
}
