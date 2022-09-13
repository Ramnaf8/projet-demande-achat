<?php

//declare(strict_types=1);

namespace App\Services;

use App\Traits\RequestService;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

//use function config;

class CommandeService
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
        $this->baseUri = env('COMMANDE_SERVICE_BASE_URI');
    //$this->secret = config('services.commande.secret');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * 
     * @return string
     */
    public function fetchCommandes($user_id): string
    {
        // $jwt = $request->cookie('jwt');
        // return $this->request('GET', "/api/commande/{$user_id}", [], ['Authorization' => 'bearer ' . $jwt]);
        return $this->request('GET', "/api/commande/{$user_id}");
    }

    /**
     * @param $commande
     *
     * @return string
     */
    public function fetchCommande($user_id, $commande): string
    {
        return $this->request('GET', "/api/commande/{$user_id}/{$commande}");
    }

    /**
     * @param $data
     *
     * @return string
     */
    public function createCommande($user_id, $data): string
    {
        return $this->request('POST', "api/commande/{$user_id}", $data);
    }

    /**
     * @param $commande
     * @param $data
     *
     * @return string
     */
    public function updateCommande($user_id, $commande, $data): string
    {
        return $this->request('PUT', "/api/commande/{$user_id}/{$commande}", $data);
    }

    /**
     * @param $commande
     *
     * @return string
     */
    public function deleteCommande($user_id, $commande): string
    {
        return $this->request('DELETE', "/api/commande/{$user_id}/{$commande}");
    }

    public function payerCommande($user_id, $commande, $data): string
    {
        return $this->request('POST', "/api/commande/payer/{$user_id}/{$commande}", $data);
    }
}
