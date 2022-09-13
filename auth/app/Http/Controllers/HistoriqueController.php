<?php

//declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\HistoriqueService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoriqueController extends Controller
{
    /**
     * @var \App\Services\HistoriqueService
     */
    protected $HistoriqueService;

    
    /**
     * HistoriqueController constructor.
     *
     * @param \App\Services\HistoriqueService   $HistoriqueService
     */
    public function __construct(HistoriqueService $HistoriqueService)
    {
        $this->HistoriqueService = $HistoriqueService;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * 
     * @return mixed
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        return $this->successResponse($this->HistoriqueService->fetchHistoriques($user_id));
    }

    /**
     * @param $Historique
     *
     * @return mixed
     */
    public function show($Historique)
    {
        $user_id = Auth::user()->id;
        return $this->successResponse($this->HistoriqueService->fetchHistorique($user_id, $Historique));
    }
}