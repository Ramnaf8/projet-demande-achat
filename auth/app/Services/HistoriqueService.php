<?php

//declare(strict_types=1);

namespace App\Services;

use App\Traits\RequestService;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

//use function config;

class HistoriqueService
{
    use RequestService;

    /**
     * @var string
     */
    protected $baseUri;

    // /**
    //  * @var string
    //  */
    // protected $secret;

    public function __construct()
    {
        $this->baseUri = env('HISTORIQUE_SERVICE_BASE_URI');
    //$this->secret = config('services.Historique.secret');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * 
     * @return string
     */
    public function fetchHistoriques($user_id): string
    {
        // $jwt = $request->cookie('jwt');
        // return $this->request('GET', "/api/Historique/{$user_id}", [], ['Authorization' => 'bearer ' . $jwt]);
        return $this->request('GET', "/api/historique/{$user_id}");
    }

    /**
     * @param $Historique
     *
     * @return string
     */
    public function fetchHistorique($user_id, $Historique): string
    {
        return $this->request('GET', "/api/historique/{$user_id}/{$Historique}");
    }

    /**
     * @param $data
     *
     * @return string
     */
    public function createHistorique($user_id, $data): string
    {
        return $this->request('POST', "api/historique/{$user_id}", $data);
    }
   
}
