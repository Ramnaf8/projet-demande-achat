<?php

//declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\CommandeService;
use App\Services\ProduitService;
use App\Services\HistoriqueService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    /**
     * @var \App\Services\CommandeService
     */
    protected $commandeService;

    /**
     * @var \App\Services\ProduitService
     */
    protected $produitService;

    /**
     * @var \App\Services\HistoriqueService
     */
    protected $historiqueService;
    /**
     * CommandeController constructor.
     *
     * @param \App\Services\CommandeService   $commandeService
     * @param \App\Services\ProduitService $produitService
     * @param \App\Services\HistoriqueService $historiqueService
     */
    public function __construct(CommandeService $commandeService, ProduitService $produitService, HistoriqueService $historiqueService)
    {
        $this->commandeService = $commandeService;
        $this->produitService = $produitService;
        $this->historiqueService = $historiqueService;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * 
     * @return mixed
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        return $this->successResponse($this->commandeService->fetchCommandes($user_id));
    }

    /**
     * @param $commande
     *
     * @return mixed
     */
    public function show($commande)
    {
        $user_id = Auth::user()->id;
        return $this->successResponse($this->commandeService->fetchCommande($user_id, $commande));
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $produit_id = $request->input('produit_id');
        $produit = $this->produitService->fetchProduit($produit_id);
        $prix = json_decode($produit, true)["data"]["prix"];
        return $this->successResponse($this->commandeService->createCommande($user_id, array_merge($request->all(), ['prix' => $prix])));
    }

    /**
     
     * @param                          $commande
     * @param \Illuminate\Http\Request $request
     * 
     * @return mixed
     */
    public function update($commande, Request $request)
    {
        $user_id = Auth::user()->id;
        return $this->successResponse($this->commandeService->updateCommande($user_id, $commande, $request->all()));
    }

    /**
     * @param $commande
     *
     * @return mixed
     */
    public function destroy($commande)
    {
        $user_id = Auth::user()->id;
        return $this->successResponse($this->commandeService->deleteCommande($user_id, $commande));
    }

    /**
     * @param $commande
     *
     * @return mixed
     */

    public function SupprimerCommandeEtGererQuantiteProduit($commande, Request $request)
    {
        // Cette fonction permet de verifier si la commande choisit appartient à l'utilisateur authentifié
        // puis, verifier si la quantité du produit de cette commande est inférieur a la quantite désiré dans la commande
        // ensuite, modifier la table des produits en insérant la nouvelle quantité
        // par la suite, insérer la commande dans la table historique
        // enfin, supprimer la commande
        // PS : il manque la logique du paiement avant la suppression
        $user_id = Auth::user()->id;
        $commande_objet = $this->commandeService->fetchCommande($user_id, $commande);
        $produit_id = json_decode($commande_objet, true)["data"]["produit_id"];
        $produit = $this->produitService->fetchProduit($produit_id);
        $quantite = json_decode($produit, true)["data"]["quantite"];
        if ($newQuantite = $this->commandeService->payerCommande($user_id, $commande, array_merge($request->all(), ['quantiteProduit' => $quantite]))) {
            $req = $this->produitService->updateProduit($produit_id, array_merge($request->all(), ['quantite' => json_decode($newQuantite, true)["data"]]));
            // TODO : paiement
            $req2 = $this->historiqueService->createHistorique($user_id, array_merge($request->all(),[
                'produit_id' => $produit_id,
                'quantite' => json_decode($commande_objet, true)["data"]["quantite"],
                'prix_total' => json_decode($commande_objet, true)["data"]["prix_total"],
            
            ]));
            
            
            return $this->successResponse($this->commandeService->deleteCommande($user_id, $commande));
        }
        return $this->errorResponse("Erreur", 404);
    //return $this->successResponse($this->commandeService->payerCommande($user_id, $commande));
    }
}
