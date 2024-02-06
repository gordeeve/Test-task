<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Actions\Tasks\CreateTask;
use App\Actions\Tasks\DeleteTask;
use App\Actions\Tasks\GetTaskList;
use App\Actions\Tasks\SetTaskFinished;
use App\Actions\Tasks\ShowTask;
use App\Actions\Tasks\UpdateTask;
use App\DTO\FilterDTO;
use App\DTO\TaskDTO;
use App\Enums\Messages;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class TaskController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/tasks",
     *      operationId="getTasks",
     *      tags={"Tasks"},
     *      summary="Get list of user's tasks",
     *      description="Returns list of tasks",
     *     @OA\Parameter(
     *         in="header",
     *         name="Authorization",
     *         required=true,
     *         description="Authorization Bearer Key",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="path",
     *         name="status",
     *         required=false,
     *         description="status of task, for example status=done, status=todo",
     *         @OA\Schema(type="string")
     *     ),
     *    @OA\Parameter(
     *         in="path",
     *         name="title",
     *         required=false,
     *         description="the word contained in the title of task, for example title=some title. ",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="path",
     *         name="description",
     *         required=false,
     *         description="the word contained in the description of task, for example description=some title. ",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="path",
     *         name="priority",
     *         required=false,
     *         description="Filterd by field Priority, for example prioriy=3",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         in="path",
     *         name="sortBy",
     *         required=false,
     *         description="Sort by field, for example sortBy=priority.
     *         Possible values - priority, createdAt, completedAt",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="path",
     *         name="andSortBy",
     *         required=false,
     *         description="Additional sorting by field, for example andSortBy=createdAt.
     *         Possible values - priority, createdAt, completedAt",
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TaskResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function index(Request $request, GetTaskList $getTaskList): JsonResponse
    {
        $tasks =  $getTaskList->run(new FilterDTO(
            id: $request->id,
            title: $request->title,
            description: $request->description,
            status: $request->status,
            priority: $request->priority,
            sortBy: $request->sortBy,
            andSortBy: $request->andSortBy
        ));

        return response()->json(['tasks' => $tasks->paginate()], Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *      path="/api/tasks",
     *      operationId="storaTask",
     *      tags={"Tasks"},
     *      summary="Store new tasks",
     *      description="Store new tasks",
     *
     *    @OA\Parameter(
     *         in="header",
     *         name="Authorization",
     *         required=true,
     *         description="Authorization of current user",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="title",
     *         required=true,
     *         description="the word contained in the title of task, for example title=some title. ",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="description",
     *         required=false,
     *         description="the word contained in the description of task, for example description=some title. ",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="status",
     *         required=false,
     *         description="status of task, for example status=done, status=todo",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="priority",
     *         required=false,
     *         description="Filterd by field Priority, for example prioriy=3",
     *         @OA\Schema(type="integer")
     *     ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TaskResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function store(Request $request, CreateTask $createTask): JsonResponse
    {
        $dto = new TaskDTO(
            id: $request->id,
            title: $request->title,
            priority: $request->priority,
            description: $request->description,
            status: $request->status,
            completedAt: $request->compleatedAt,
            user_id: Auth::id()
        );

        $task =  $createTask->run($dto);

        return response()->json([
            'task' => $task,
            'message' => 'success'
        ], Response::HTTP_CREATED);
    }


    /**
     * @OA\Get(
     *      path="/api/tasks/{task_id}",
     *      operationId="getTask",
     *      tags={"Tasks"},
     *      summary="Get the task",
     *      description="Get the task",
     *
     *     @OA\Parameter(
     *         in="header",
     *         name="Authorization",
     *         required=true,
     *         description="Authorization of current user",
     *         @OA\Schema(type="string")
     *     ),
     *    @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="the word contained in the title of task, for example title=some title. ",
     *         @OA\Schema(type="string")
     *     ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TaskResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function show(string $id, ShowTask $showTask) : JsonResponse
    {
        $dto = new TaskDTO(
            id: $id
        );

        $task =  $showTask->run($dto);

        return response()->json([
            'task' => $task,
            'message' => 'success'
        ], Response::HTTP_OK);
    }


    /**
     * @OA\Put(
     *      path="/api/tasks",
     *      operationId="updateTask",
     *      tags={"Tasks"},
     *      summary="Update task",
     *      description="Update task",
     *
     *     @OA\Parameter(
     *         in="header",
     *         name="Authorization",
     *         required=true,
     *         description="Authorization of current user",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="Id of the task",
     *         @OA\Schema(type="string")
     *     ),
     *    @OA\Parameter(
     *         in="query",
     *         name="title",
     *         required=true,
     *         description="the word contained in the title of task, for example title=some title. ",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="description",
     *         required=false,
     *         description="the word contained in the description of task, for example description=some title. ",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="status",
     *         required=false,
     *         description="status of task, for example status=done, status=todo",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="priority",
     *         required=false,
     *         description="Filterd by field Priority, for example prioriy=3",
     *         @OA\Schema(type="integer")
     *     ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TaskResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function update(Request $request, int $id, UpdateTask $updateTask)
    {
        $dto = new TaskDTO(
            id: $id,
            title: $request->title,
            priority: $request->priority,
            description: $request->description,
            status: $request->status,
            completedAt: $request->compleatedAt,
            user_id: Auth::id()
        );


        $task =  $updateTask->run($dto);

        return response()->json([
            'task' => $task,
            'message' => 'success'
        ], Response::HTTP_ACCEPTED);
    }


    /**
     * @OA\Delete(
     *      path="/api/tasks/{task_id}",
     *      operationId="deleteTask",
     *      tags={"Tasks"},
     *      summary="Delete the task",
     *      description="Delete the task",
     *
     *     @OA\Parameter(
     *         in="header",
     *         name="Authorization",
     *         required=true,
     *         description="Authorization of current user",
     *         @OA\Schema(type="string")
     *     ),
     *    @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="the word contained in the title of task, for example title=some title. ",
     *         @OA\Schema(type="string")
     *     ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function destroy(string $id, DeleteTask $deleteTask)
    {
        $dto = new TaskDTO(
            id: $id
        );

        if( $deleteTask->run($dto) ){

            return response()->json([
                'message' => 'success'
            ], Response::HTTP_NO_CONTENT);

        }


        return response()->json([
            'message' => Messages::TASK_STATUS_DONE->value
        ], Response::HTTP_METHOD_NOT_ALLOWED);

    }

    /**
     * @OA\Post(
     *      path="/api/tasks/{task_id}/set-done",
     *      operationId="setDoneTask",
     *      tags={"Tasks"},
     *      summary="Set task done",
     *      description="Set task done",
     *
     *     @OA\Parameter(
     *         in="header",
     *         name="Authorization",
     *         required=true,
     *         description="Authorization of current user",
     *         @OA\Schema(type="string")
     *     ),
     *    @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="the word contained in the title of task, for example title=some title. ",
     *         @OA\Schema(type="string")
     *     ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TaskResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function setTaskDone(int $id, SetTaskFinished $setTaskFinished)
    {
        $dto = new TaskDTO(
            id: $id
        );

        $task = $setTaskFinished->run($dto);

        return response()->json([
            'task' => $task,
            'message' => 'success'
        ], Response::HTTP_OK);
    }
}
