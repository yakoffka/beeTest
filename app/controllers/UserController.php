<?php


namespace App\controllers;


use App\models\User;

class UserController
{

    public function create(string $name, string $email, string $password)
    {
        $user = new User;
        $user->save(
            [
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]
        );
    }

    public function show()
    {

    }

    public function store()
    {

    }

    public function edit()
    {

    }


}