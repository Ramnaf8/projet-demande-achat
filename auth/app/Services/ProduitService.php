<?php

//declare(strict_types=1);

namespace App\Services;

use App\Traits\RequestService;

//use function config;

class ProduitService
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

    /**
     * ProduitService constructor.
     */
    public function __construct()
    {
        $this->baseUri = env('PRODUIT_SERVICE_BASE_URI');
    // $this->secret = config('services.produit.secret');
    }

    /**
     * @return string
     */
    public function fetchProduits(): string
    {
        return $this->request('GET', '/api/produit');
    }

    /**
     * @param $produit
     *
     * @return string
     */
    public function fetchProduit($produit): string
    {
        return $this->request('GET', "/api/produit/{$produit}");
    }

    /**
     * @param $data
     *
     * @return string
     */
    public function createProduit($data): string
    {
        return $this->request('POST', '/api/produit', $data);
    }

    /**
     * @param $produit
     * @param $data
     *
     * @return string
     */
    public function updateProduit($produit, $data): string
    {
        return $this->request('PUT', "/api/produit/{$produit}", $data);
    }

    /**
     * @param $produit
     *
     * @return string
     */
    public function deleteProduit($produit): string
    {
        return $this->request('DELETE', "/api/produit/{$produit}");
    }
}
