<?php

/**
 * Class RectifyTimeTaskController
 * @package App\Infrastructure\Controller
 */

namespace App\Infrastructure\Controller;

use App\Domain\Service\TimeTaskServiceInterface;
use App\Infrastructure\DataTransferObject\TimeTaskDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

class RectifyTimeTaskController extends AbstractController
{
    private TimeTaskServiceInterface $timeTaskService;
    private SerializerInterface $serializer;

    public function __construct(
        SerializerInterface $serializer,
        TimeTaskServiceInterface $timeTaskService
    )
    {
        $this->serializer = $serializer;
        $this->timeTaskService = $timeTaskService;
    }

    /**
     *  Require ROLE_TECHNICAL for all the actions of this controller
     * @IsGranted("ROLE_SUPERVISOR")
     *
     * @Route("/registers-to-rectify", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function registersToRectify() : Response
    {
        $timesTasks = $this->timeTaskService->timesTasksToRectify();

        return $this->render('rectify/index.html.twig', [
            'timesTasks' => $timesTasks,
        ]);
    }

    /**
     *  Require ROLE_TECHNICAL for all the actions of this controller
     * @IsGranted("ROLE_SUPERVISOR")
     *
     * @Route("/rectify/{id}", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function editTimeTask(int $id) : Response
    {
        $timeTask = $this->timeTaskService->findOpenedById($id);

        return $this->render('rectify/rectifyForm.html.twig', [
                'TimeTask' => $timeTask
        ]);
    }

    /**
     *  Require ROLE_TECHNICAL for all the actions of this controller
     * @IsGranted("ROLE_SUPERVISOR")
     *
     * @Route("/rectify", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function rectifyTimeTask(Request $request) : Response
    {
        try{

            $timeTaskJson = json_encode($request->get('timeTask'));

            $endTime = $request->get('endTimeTask');

            $timeTaskDTO = $this->serializer->deserialize($timeTaskJson,TimeTaskDTO::class, 'json');


            $result = $this->timeTaskService->finishingTimeTask($timeTaskDTO, $endTime);

            if ($result) {
                $arrResponse = [
                    'message' => 'Registro Retificado com Sucesso!',
                    'typeMessage' => 'success',
                    'redirect' => '/registers-to-rectify'
                ];
            }

            if (!$result) {
                $arrResponse = [
                    'message' => 'Houve um Erro Contate o Suporte',
                    'typeMessage' => 'success',
                ];
            }

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
}
