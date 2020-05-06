<?php


namespace App\controllers;


use App\services\NotificationService;
use App\services\ValidatorService;

class BaseController
{
    protected array $rules = [];
    protected ValidatorService $validator;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->validator = new ValidatorService();
    }

    /**
     * @param string $to
     */
    public function redirect(string $to): void
    {
        session_write_close();
        header('Location: ' . $to);
        die();
    }

    /**
     * @param $errors
     */
    protected function abortIf($errors): void
    {
        if (!empty($errors)) {
            foreach ($errors as $error) {
                NotificationService::sendError($error);
            }
            $this->redirect(APP_URL);
        }
    }

    /**
     * @param array $values
     * @param array $rules
     */
    public function checkRules(array $values, array $rules): void
    {
        array_map(function (string $key, string $val, string $strThisFieldRules) use (&$errors) {
            $thisFieldRules = $this->validator->explodeString($strThisFieldRules);
            foreach ($thisFieldRules as $rule) {
                if (!$this->validator->{'is' . ucfirst($rule)}($val)) {
                    $errors[] = $key . ' field mast be ' . $rule;
                }
            }
        }, array_keys($values), $values, $rules);

        $this->abortIf($errors);
    }

    /**
     * @param array $fields
     * @return array
     */
    protected function getNecessaryRules(array $fields): array
    {
        $rules = $this->rules;
        foreach ($rules as $key => $val) {
            if (!in_array($key, $fields, true)) {
                unset($rules[$key]);
            }
        }
        return $rules;
    }

    /**
     * @param string $input
     * @return string
     */
    protected function clean(string $input): string
    {
        return trim(htmlspecialchars(strip_tags($input)));
    }

    /**
     * @param array $fields
     * @param array $rules
     * @return array
     */
    protected function getCleanPostRequest(array $fields, array $rules): array
    {
        foreach ($fields as $key => $field) {

            $cleanValues[$field] = $this->clean($_POST[$field] ?? '');

            if (in_array('bool', $this->validator->explodeString($rules[$field]), true)) {
                $cleanValues[$field] = (bool)$cleanValues[$field];
            }
        }

        return $cleanValues ?? [];
    }

    /**
     * @param array $fields
     * @return array
     */
    private function getCleanGetRequest(array $fields): array
    {
        return array_map(function (string $key) {
            return $this->clean($_GET[$key] ?? '');
        }, array_keys($fields));
    }

    /**
     * @param array $fields
     * @return array
     */
    protected function getValidated(array $fields): array
    {
        $rules = $this->getNecessaryRules($fields);
        $values = $this->getCleanPostRequest($fields, $rules);
        $this->checkRules($values, $rules);

        return $values;
    }
}