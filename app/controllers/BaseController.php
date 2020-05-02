<?php


namespace App\controllers;


use App\services\NotificationService;
use App\services\ValidatorService;

class BaseController
{
    public array $fieldsRules = [];
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
     * @param array $fieldsRules
     */
    public function checkRules(array $values, array $fieldsRules): void
    {
        array_map(function (string $key, string $val, string $strRules) use (&$errors) {

            $rules = $this->validator->getRules($strRules);
            foreach ($rules as $rule) {
                if (!$this->validator->{'is' . ucfirst($rule)}($val)) {
                    $errors[] = $key . ' field mast be ' . $rule;
                }
            }
        }, array_keys($values), $values, $fieldsRules);

        $this->abortIf($errors);
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
     * @return array
     */
    protected function getCleanPostRequest(array $fields): array
    {
        foreach ($fields as $field) {
            $cleanValues[$field] = $this->clean($_POST[$field]) ?? '';
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
            return $this->clean($_GET[$key]) ?? '';
        }, array_keys($fields));
    }

    /**
     * @param array $fields
     * @return array
     */
    protected function validate(array $fields): array
    {
        $values = $this->getCleanPostRequest($fields);
        $fieldsRules = $this->fieldsRules;
        $this->checkRules($values, $fieldsRules);

        return $values;
    }
}