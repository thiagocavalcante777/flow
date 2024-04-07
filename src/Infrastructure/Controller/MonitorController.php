<?php

/**
 * Class MonitorController
 * @package App\Infrastructure\Controller
 */


namespace App\Infrastructure\Controller;


use App\Domain\Service\TimeTaskServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MonitorController extends AbstractController
{
    private TimeTaskServiceInterface $timeTaskService;
    private SerializerInterface $serializer;

    public function __construct(
        SerializerInterface $serializer,
        TimeTaskServiceInterface $timeTaskService
    )
    {
        parent::__construct();

        $this->serializer = $serializer;
        $this->timeTaskService = $timeTaskService;
    }

    /**
     * @Route("/monitor", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function monitorPage() : Response
    {
        return $this->render('monitor/index.html.twig', []);
    }


    /**
     * @Route("/monitor-times-tasks", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function monitorTimeTasks() : Response
    {
        $timesTasks = $this->timeTaskService->timesTasksToMonitor();

        $jsonResponse = $this->serializer->serialize($timesTasks, 'json');

        return JsonResponse::fromJsonString($jsonResponse,JsonResponse::HTTP_OK);
    }
}
