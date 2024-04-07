<?php

/**
 * Class HomeController
 * @package App\Infrastructure\Controller
 */


namespace App\Infrastructure\Controller;
use App\Domain\Service\ProcessBarCodeServiceInterface;
use App\Domain\Service\TimeTaskServiceInterface;
use App\Infrastructure\DataTransferObject\TimeTaskDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use DateTime;

class ProcessBarCodeController extends AbstractController
{
    private ProcessBarCodeServiceInterface $processBarCodeService;
    private SerializerInterface $serializer;
    private TimeTaskServiceInterface $timeTaskService;

    public function __construct(
        SerializerInterface $serializer,
        ProcessBarCodeServiceInterface $processBarCodeService,
        TimeTaskServiceInterface $timeTaskService
    )
    {
        $this->serializer = $serializer;
        $this->processBarCodeService = $processBarCodeService;
        $this->timeTaskService = $timeTaskService;
    }

    /**
     * Require ROLE_TECHNICAL for all the actions of this controller
     * @IsGranted("ROLE_TECHNICAL")
     *
     * @Route("/", name="app_home", methods={"GET|POST"})
     * @param Request $request
     * @return Response
     */
    public function homePage()
    {
        return $this->render('process-bar-code/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * Require ROLE_TECHNICAL for all the actions of this controller
     * @IsGranted("ROLE_TECHNICAL")
     *
     * @Route("/process-bar-code", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function processBarCode(Request $request) : Response
    {
      try{
          $barCodeString = $request->get("barCodeInput");

          $timeTaskJson = json_encode($request->get('timeTask'));

          $timeTaskDTO = $this->serializer->deserialize($timeTaskJson,TimeTaskDTO::class, 'json');

          $timeTask = $this->processBarCodeService->processBarCode($barCodeString, $timeTaskDTO);

          if (!empty($timeTask->getId())) {

              if ($timeTask->getStartTime()->format('Y-m-d') < date('Y-m-d')) {

                  $arrResponse = [
                      'timeTask' => $timeTask,
                      'message' => 'Tarefa Antiga Aberta',
                      'typeMessage' => 'warning',
                      'isOld' => true
                  ];

                  $jsonResponse = $this->serializer->serialize($arrResponse, 'json');

                  return JsonResponse::fromJsonString($jsonResponse,JsonResponse::HTTP_OK);
              }
          }

          $arrResponse = [
              'timeTask' => $timeTask,
          ];

          $jsonResponse = $this->serializer->serialize($arrResponse, 'json');

          return JsonResponse::fromJsonString($jsonResponse,JsonResponse::HTTP_OK);

      }catch (Throwable $e) {

          $arrResponse = [
              'message' => 'Houve um Erro Contate o Suporte',
              'typeMessage' => 'warning',
          ];

          $jsonResponse = $this->serializer->serialize($arrResponse, 'json');

          return JsonResponse::fromJsonString($jsonResponse,JsonResponse::HTTP_OK);
      }
    }


    /**
     * Require ROLE_TECHNICAL for all the actions of this controller
     * @IsGranted("ROLE_TECHNICAL")
     *
     * @Route("/finally-process", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function finallyProcess(Request $request) : Response
    {
        try{
            $timeTaskJson = json_encode($request->get('timeTask'));

            $timeTaskDTO = $this->serializer->deserialize($timeTaskJson,TimeTaskDTO::class, 'json');

            if (empty($timeTaskDTO->getId())) {

                $result = $this->timeTaskService->startTimeTask($timeTaskDTO);

                $arrResponse = [
                    'message' => 'Tarefa Iniciada Com Sucesso',
                    'typeMessage' => 'success'
                ];

                $jsonResponse = $this->serializer->serialize($arrResponse, 'json');

                return JsonResponse::fromJsonString($jsonResponse,JsonResponse::HTTP_OK);
            }

            if (!empty($timeTaskDTO->getId())) {

                $result = $this->timeTaskService->finishingTimeTask($timeTaskDTO);

                $arrResponse = [
                    'message' => 'Tarefa Fechada Com Sucesso',
                    'typeMessage' => 'success'
                ];

                $jsonResponse = $this->serializer->serialize($arrResponse, 'json');

                return JsonResponse::fromJsonString($jsonResponse,JsonResponse::HTTP_OK);
            }

        }catch (Throwable $e){
            dd($e->getMessage());
            $arrResponse = [
                'message' => 'Houve um Erro Contate o Suporte',
                'typeMessage' => 'warning',
            ];

            $jsonResponse = $this->serializer->serialize($arrResponse, 'json');

            return JsonResponse::fromJsonString($jsonResponse,JsonResponse::HTTP_OK);
        }
    }
}
