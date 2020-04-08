<?php

namespace App\Controller;

use App\Service\AlgorithmService;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class TestController extends AbstractController
{
    /** @var AlgorithmService */
    private $algorithmService;

    /** @var ValidatorInterface */
    private $validator;

    public function __construct(AlgorithmService $algorithmService, ValidatorInterface $validator) {
        $this->algorithmService = $algorithmService;
        $this->validator = $validator;
    }

    /**
     * @Route("/algorithm", name="algorithm")
     */
    public function index(Request $request)
    {
        $results = [];

        if ($request->isMethod(Request::METHOD_POST)) {
            //dd($request->request->all());
//            for ($i=0; $i<10; $i++) {
//                $number = 'number';
//                $number .= (string)$i;
//                $result = $request->request->get($number);
//                dd($result);
//                //dd($request->request->all());
//
//                //$results[] = $this->algorithmService->getMaxValueInNumberString($result) ?: 'no number entered';
//                //dd();
//                var_dump($request->request->all());
//            }

            //$numbers = array_map('trim', preg_split("/[,;]/", $request->request->get('numbers')));
            //$numbers = array_map('trim', preg_split("/[,| |;.]/", $request->request->get('numbers')));

//            $errors = $this->validator->validate($numbers, new Assert\Regex([
//                    'pattern' => '/^[0-9]\d*$/',
//                ]
//            ));

//            if (count($errors) > 0 || count($numbers) > 10 ) {
//                dd('zle');
//            }

            //dd($request->request->all());
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
