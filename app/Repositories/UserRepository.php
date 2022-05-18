<?php

namespace App\Repositories;

class UserRepository extends Repository
{
    public function model(){
        return 'App\Models\User';
    }
}
