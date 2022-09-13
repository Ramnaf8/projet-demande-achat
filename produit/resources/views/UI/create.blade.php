<!-- create.blade.php -->

@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
   Ajouter un produit
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('produit') }}">
        @csrf
          <div class="form-group">
              <label for="nom">nom :</label>
              <input type="text" class="form-control" name="nom"/>
          </div>
          <div class="form-group">
              <label for="prix">Prix :</label>
              <input type="text" class="form-control" name="prix"/>
          </div>
          <div class="form-group">
            <label for="quantite">quantite :</label>
            <input type="text" class="form-control" name="quantite"/>
        </div>
        <div class="form-group">
            <label for="nom">description :</label>
            <input type="text" class="form-control" name="nom"/>
        </div>
          <button type="submit" class="btn btn-primary">Ajouter produit</button>
      </form>
  </div>
</div>
@endsection