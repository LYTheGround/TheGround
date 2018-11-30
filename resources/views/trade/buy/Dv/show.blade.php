@extends('layouts.app')
@section('page-title')
    Devi
@stop
@section('content')
    <!-- cette page contiendra la list des orders indiquez dans le devi: -->
    <div class="content container-fluid">
        <!--
            - titre de la page : Devi
            - boutons:
                - bouton pour sélectionné ce devi si il n'est pas le cas ou n'est pas confirmé.
                - bouton pour supprimé ce devi.
                - bouton pour modifier ce devi.
        -->
        <div class="row m-b-30">
            <div class="col-xs-5">
                <h3>Devi</h3>
            </div>
            <div class="col-xs-7 text-right">
                <a href="#" class="btn btn-success">select</a>
                <a href="#" class="btn btn-warning">edit</a>
                <a href="#" class="btn btn-danger">delete</a>
            </div>
        </div>
        <!--
            -   un cadre de fournisseur:
                -   le nom du fournisseur en url a fin d'afficher le profil de ce dernier.
        -->
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4">
                <div class="profile-widget">
                    <div class="profile-img">
                        <a href="#" class="avatar">F</a>
                    </div>
                    <h4 class="user-name m-t-10 m-b-0 text-ellipsis"><a href="#">{{ $provider->info_box->name }}</a></h4>
                    <h5 class="user-name m-t-10 m-b-0 text-ellipsis"><a href="#">{{ $provider->info_box->speaker . ': '. $provider->info_box->tels[0]->tel }}</a></h5>
                    <a href="#" class="btn btn-default btn-sm m-t-10">View Profile</a>
                </div>
            </div>
        </div>
        <!--
            -   un tableau qui contenir:
                + en boucle
                    -   le nom du produit avec son images si possible en url pour la redirection vers son profil.
                    -   la Quantité.
                    -   le prix unitaire.
                    -   le prix HT pour toute la Quantité.
                    -   la TVA a payer.
                    -   le prix en TTC.
                + la dernière ligne les montants total de
                    -   HT.
                    -   TVA.
                    -   TTC.
        -->
        <div class="row">
            <div class="col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table">
                        <thead>
                        <tr>
                            <th>produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>HT</th>
                            <th>TVA</th>
                            <th class="text-right">TTC</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>
                                <a href="#" class="avatar">P</a>
                                <a href="#"><h2>{{ $order->bc->product->name }}</h2></a>
                            </td>
                            <td>{{ $order->bc->qt }}</td>
                            <td>{{ $order->pu }}</td>
                            <td>{{ $order->ht }}</td>
                            <td>{{ $order->tva }}</td>
                            <td class="text-right">{{ $order->ttc }}</td>
                        </tr>
                        @endforeach
                        <tr class="success">
                            <td colspan="3" class="text-center text-primary"><h3>TOTALE</h3></td>
                            <td>{{ $dv->ht }}</td>
                            <td>{{ $dv->tva }}</td>
                            <td class="text-right text-danger"><h4>{{ $dv->ttc }}</h4></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
