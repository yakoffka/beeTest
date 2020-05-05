<?php

namespace App\controllers;

use App\models\Task;
use App\services\NotificationService;
use Illuminate\Database\Eloquent\Collection;

class TaskController extends BaseController
{
    protected array $rules = [
        'user_name' => 'required',
        'email' => 'required|email',
        'name' => 'required',
        'description' => 'required',
        'done' => 'bool',
    ];

    /**
     * Display a listing of the resource and form for creating a new resource.
     * @return array
     */
    public function index(): array
    {
        return [
            'view' => 'tasks/index',
            'tasks' => $this->getTasks(),
            'currPage' => $this->getCurrentPage(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(): void
    {
        $task = Task::create($this->getValidated([
            'user_name',
            'email',
            'name',
            'description',
        ]));

        if ($task) {
            NotificationService::sendInfo('Task ' . $task->name . ' successfully added!');
        } else {
            NotificationService::sendError('Failed to add task.');
        }

        $this->redirect(APP_URL);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return void
     */
    public function update(): void
    {
        $this->checkAuthorizeUser();
        $task = $this->getTaskFrom('POST');

        $newProperties = $this->getValidated([
            'description',
            'done',
        ]);

        foreach ($newProperties as $key => $val) {
            $task->{$key} = $val;
        }

        // $task->edited ??= $task->isDirty('description');
        $task->getEditedStatus();

        if ($task->save()) {
            NotificationService::sendInfo('Task ' . $task->name . ' successfully edited!');
        } else {
            NotificationService::sendError('Failed to edited task.');
        }

        $this->redirect(APP_URL);
    }

    /**
     * @return int
     */
    public function getValidatedIDFromGET(): int
    {
        return $this->clean((int)$_GET['id']);
    }

    /**
     * @return int
     */
    public function getValidatedIDFromPOST(): int
    {
        return $this->clean((int)$_POST['id']);
    }

    /**
     * Sorting task list
     */
    public function setSort(): void
    {
        $nameField = $this->clean($_POST['sort'] ?? 'id');
        $_SESSION['sortName'] = $nameField;
        $_SESSION['sortDesc'] = ($_SESSION['sortDesc'] === '1') ? '0' : '1';
        $this->redirect(APP_URL);
    }

    /**
     * @return array
     */
    private function getSortField(): array
    {
        $sortField = !empty($_SESSION['sortName']) ? $_SESSION['sortName'] : 'id';
        $descending = $_SESSION['sortDesc'] ?? '0';
        return [$sortField, $descending];
    }

    /**
     * @return int
     */
    private function getCurrentPage(): int
    {
        return !empty($_GET['page']) ? $this->clean((int)($_GET['page'])) : 1;
    }

    /**
     * @return Collection
     */
    private function getTasks(): Collection
    {
        [$sortField, $descending] = $this->getSortField();
        return Task::query()
            ->where('id', '>', 0)
            ->get()
            ->sortBy($sortField, SORT_REGULAR, $descending)
            ->chunk(Task::$chunk);
    }

    /**
     * User authorization check
     */
    private function checkAuthorizeUser(): void
    {
        if (empty($_SESSION['name'])) {
            $_SESSION['login_modal_show'] = ' show';
            $this->redirect(APP_URL);
        }
    }

    /**
     * @param string $requestMethod
     * @return Task
     */
    private function getTaskFrom(string $requestMethod): Task
    {
        $task = Task::find($this->{'getValidatedIDFrom' . $requestMethod}());
        if (!$task) {
            NotificationService::sendError('Failed to get task.');
            $this->redirect(APP_URL);
        }
        return $task;
    }
}