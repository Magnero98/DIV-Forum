<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PopularityController extends Controller
{
    public function voteGoodForUser($userId)
    {
        authUserDomain()->voteGoodForUser($userId);

        return back();
    }

    public function voteBadForUser($userId)
    {
        authUserDomain()->voteBadForUser($userId);

        return back();
    }
}
