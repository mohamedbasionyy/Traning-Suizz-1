<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomService;


class CustomeController extends Controller
{
    protected $CustomService;
    public function __construct(CustomService $CustomService)
    {

    }
}
