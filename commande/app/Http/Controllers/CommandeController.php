<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class CommandeController extends Controller
{


    public function index($user_id)
    {
        $commandes = Commande::where('user_id', $user_id)->get();

        return $this->successResponse($commandes);
    }


    public function show($user_id, $id)
    {
        $commande = Commande::findOrFail($id);
        if ($commande->user_id != $user_id) {
            return $this->errorResponse("Erreur d'autorisation.",
                Response::HTTP_FORBIDDEN);
        }

        return $this->successResponse($commande);

    }
    public function store($user_id, Request $request)
    {
        $rules = [
            'produit_id' => 'required|integer',
            'quantite' => 'required|numeric|min:1',
        ];
        $this->validate($request, $rules);
        $prix_total = $request->input('quantite') * $request->input('prix');

        $commande = Commande::create([
            'user_id' => $user_id,
            'produit_id' => $request->input('produit_id'),
            'quantite' => $request->input('quantite'),
            'prix_total' => $prix_total,
        ]);

        return $this->successResponse($commande);

    }

    public function update($user_id, $id, Request $request)
    {

        $rules = [
            'quantite' => 'numeric|min:1',
        ];
        $this->validate($request, $rules);

        $commande = Commande::findOrFail($id);
        if ($commande->user_id != $user_id) {
            return $this->errorResponse("Erreur d'autorisation.",
                Response::HTTP_FORBIDDEN);
        }

        $prix_total = $request->input('quantite') * ($commande->prix_total / $commande->quantite);
        $commande = $commande->fill([
            'user_id' => $commande->user_id,
            'produit_id' => $commande->produit_id,
            'quantite' => $request->input('quantite'),
            'prix_total' => $prix_total,
        ]);

        if ($commande->isClean()) {
            return $this->errorResponse('La quantité doit étre modifié.',
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $commande->save();
        return $this->successResponse($commande);

    }

    public function destroy($user_id, $id)
    {


        $commande = Commande::findOrFail($id);
        if ($commande->user_id != $user_id) {
            return $this->errorResponse("Erreur d'autorisation.",
                Response::HTTP_FORBIDDEN);
        }
        $commande->delete();
        return $this->successResponse($commande);

    }

    //pour payer une commande
    public function SupprimerCommandeEtGererQuantiteProduit($user_id, $id, Request $request)
    {


        $commande = Commande::findOrFail($id);
        if ($commande->user_id != $user_id) {
            return $this->errorResponse("Erreur d'autorisation.",
                Response::HTTP_FORBIDDEN);
        }
        if ($commande->quantite > $request->input('quantiteProduit'))
            return $this->errorResponse("Quantite desiré indisponible", Response::HTTP_BAD_REQUEST);

        $new_quantite = $request->input('quantiteProduit') - $commande->quantite;
        return $this->successResponse($new_quantite);
    //return $this->destroy($id);
    }
}
