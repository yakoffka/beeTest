<?php

namespace App\controllers;

use App\models\Task;
use App\services\NotificationService;
use Illuminate\Database\Eloquent\Collection;

class TaskController extends BaseController
{
    public array $fieldsRules = [
        'user_name' => 'required',
        'email' => 'required|email',
        'name' => 'required',
        'description' => 'required',
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
        $task = Task::create($this->validate([
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
     * @param $id
     * @return array
     */
    public function show($id): array
    {
        // @todo: реализовать метод!
        return [];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return void|array
     */
    public function edit(): ?array
    {
        $this->authorizeUser();
        $task = Task::find($this->getValidatedIDFromGet());
        
        if ($task) {
            return [
                'view' => 'tasks/show',
                'task' => $task,
            ];
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
        $this->authorizeUser();
        $task = $this->getTask();
        $this->updateEdited($task);
        $this->redirect(APP_URL);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($id): void
    {
        // @todo: реализовать метод!
        $this->redirect(APP_URL);
    }

    /**
     * @return int
     */
    public function getValidatedIDFromGet(): int
    {
        return $this->clean((int)$_GET['id']);
    }

    /**
     * @return int
     */
    public function getValidatedIDFromPost(): int
    {
        return $this->clean((int)$_POST['id']);
    }

    /**
     * sorting task list
     */
    public function setSort(): void
    {
        $nameField = $this->clean($_POST['sort']) ?? 'id';
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
     * @return array
     */
    private function getValidatedData(): array
    {
        $taskData = $this->getCleanCreateData();

        $errors = [];
        foreach ($taskData as $nameField => $value) {
            if ($value === '') {
                $errors[] = $nameField . ' field must be filled';
            }
            if (($nameField === 'email') && preg_match('~.+@.+\..+~', $value) !== 1) {
                $errors[] = 'Field ' . $nameField . ' is not valid';
            }
        }

        if (!empty($errors)) {
            NotificationService::sendError($errors);
            $this->redirect(APP_URL);
        }
        return $taskData;
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
     * @return array
     */
    private function getCleanCreateData(): array
    {
        return [
            'user_name' => $this->clean($_POST['user_name']) ?? '',
            'email' => $this->clean($_POST['email']) ?? '',
            'name' => $this->clean($_POST['name']) ?? '',
            'description' => $this->clean($_POST['description']) ?? ''
        ];
    }

    /**
     * @return array
     */
    private function getCleanUpdateData(): array
    {
        return [
            'description' => $this->clean($_POST['description'] ?? ''),
            'done' => $this->clean($_POST['done'] ?? '') ? '1' : '0',
        ];
    }


    /**
     * user authorization check
     */
    private function authorizeUser(): void
    {
        if (empty($_SESSION['name'])) {
            $this->redirect(LOGIN_URL);
        }
    }

    /**
     * @return Task|null
     */
    private function getTask(): ?Task
    {
        $task = Task::find($this->getValidatedIDFromPost());
        if (!$task) {
            NotificationService::sendError('Failed to edited task.');
            $this->redirect(APP_URL);
        }
        return $task;
    }

    /**
     * @param $task
     */
    private function updateEdited($task): void
    {
        $dataFromRequest = $this->getCleanUpdateData();
        $task->description = $dataFromRequest['description'];
        $task->done = $dataFromRequest['done'];
        if ($task->isDirty('description')) {
            $task->edited = true;
        }

        if ($task->save()) {
            NotificationService::sendInfo('Task ' . $task->name . ' successfully edited!');
        } else {
            NotificationService::sendError('Failed to edited task.');
        }
    }
}