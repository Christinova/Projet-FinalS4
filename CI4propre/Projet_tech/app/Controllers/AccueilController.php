<?php

namespace App\Controllers;


class AccueilController extends BaseController
{
    public function index()
    {
        return view('accueil/index');
    }
}