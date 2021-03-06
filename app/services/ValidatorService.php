<?php


namespace App\services;


class ValidatorService
{

    /**
     * преобразует строку с правилами валидации в массив с разделителем, равным по умолчанию '|'
     *
     * @param string $rules
     * @param string $delimiter
     * @return array
     */
    public function explodeString(string $rules, $delimiter = '|'): array
    {
        return explode($delimiter, $rules);
    }

    /**
     * проверка на непустую строку
     *
     * @param string $value
     * @return bool
     */
    public function isRequired(string $value): bool
    {
        return $value !== '';
    }

    /**
     * проверка строки на соответствие самому простому шаблону электронной почты
     * должно быть ТОЛЬКО одно вхождение!
     *
     * @param string $value
     * @return bool
     */
    public function isEmail(string $value): bool
    {
        return preg_match('~.+@.+\..+~', $value) === 1;
    }


    /**
     * проверка на уникальное значение $value в таблице $nameTable за исключением записи с идентификатором $except
     *
     * @param string $value
     * @param string $nameTable
     * @param int $except
     * @return bool
     */
    public function isUnique(string $value, string $nameTable, int $except = null): bool
    {
        // @todo: описать метод!
        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public function isBool($value): bool
    {
        return in_array($value, [true, false, 'on', '', '1', '0'], true);
    }
}