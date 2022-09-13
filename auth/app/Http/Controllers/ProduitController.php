<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ProduitService;
use Illuminate\Http\Request;

class ProduitController extends Controller
{

    private $produitService;

    /**
     * ProduitController constructor.
     *
     * @param \App\Services\ProduitService $produitService
     */
    public function __construct(ProduitService $produitService)
    {
        $this->produitService = $produitService;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->successResponse($this->produitService->fetchProduits());
    }

    /**
     * @param $produit
     *
     * @return mixed
     */
    public function show($produit)
    {
        return $this->successResponse($this->produitService->fetchProduit($produit));
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->produitService->createProduit($request->all()));
    }

    /**
     * @param                          $produit
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function update($produit, Request $request)
    {
        return $this->successResponse($this->produitService->updateProduit($produit, $request->all()));
    }

    /**
     * @param $produit
     *
     * @return mixed
     */
    public function destroy($produit)
    {
        return $this->successResponse($this->produitService->deleteProduit($produit));
    }
}
