<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = auth()->user();
    }

    public function showInformation()
    {
        return $this->showOne($this->user->getAuthenticatedUserInformation());
    }
}
