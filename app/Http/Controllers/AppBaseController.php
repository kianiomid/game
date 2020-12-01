<?php

namespace App\Http\Controllers;


use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Config;

class AppBaseController extends Controller
{

    public $entityManager;

    /**
     * AppBaseController constructor.
     */
    public function __construct()
    {
        $this->entityManager = Config::get('app.ENTITY_MANAGER', BaseRepository::MODE_PRODUCTION);
    }

}
