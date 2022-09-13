<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Http\Response;

class ProduitController extends Controller
{


    public function index()
    {
        $prods = Produit::all();
        return $this->successResponse($prods);
    }


    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        return $this->successResponse($produit);

    }
    public function store(Request $request)
    {
        // return Produit::create([
        //     'nom' => $request->input('nom'),
        //     'prix' => $request->input('prix'),
        //     'quantite' => $request->input('quantite'),
        //     'description' => $request->input('description'),
        // ]);
        $rules = [
            'nom' => 'required|unique:produits|max:255',
            'prix' => 'required|numeric|min:1|max:200',
            'quantite' => 'required|numeric|min:1|max:100',
            'description' => 'string',
        ];

        $this->validate($request, $rules);
        $produit = Produit::create($request->all());
        return $this->successResponse($produit);

    }



    public function update($id, Request $request)
    {
        // $produit = Produit::find($id);
        // $produit->update([
        //     'nom' => $request->input('nom'),
        //     'prix' => $request->input('prix'),
        //     'quantite' => $request->input('quantite'),
        //     'description' => $request->input('description'),
        // ]);
        // return response($produit, Response::HTTP_ACCEPTED);
        $rules = [
            'nom' => 'unique:produits|max:255',
            'prix' => 'numeric|min:1|max:200',
            'quantite' => 'numeric|min:1|max:100',
            'description' => 'string',
        ];

        $this->validate($request, $rules);
        $produit = Produit::findOrFail($id);
        $produit = $produit->fill($request->all());

        if ($produit->isClean()) {
            return $this->errorResponse('Au moin une valeur doit étre modifié.',
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $produit->save();
        return $this->successResponse($produit);

    }

    public function destroy($id)
    {
        // Produit::destroy($id);

        // return response(null, Response::HTTP_NO_CONTENT);

        $produit = Produit::findOrFail($id);
        $produit->delete();
        return $this->successResponse($produit);

    }
}
