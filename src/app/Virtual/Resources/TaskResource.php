<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="ProjectResource",
 *     description="Project resource",
 *     @OA\Xml(
 *         name="ProjectResource"
 *     )
 * )
 */
class TaskResource
{
    /**
     * @OA\Property(
     *     title="Task data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Task[]
     */
    private $task;
}
