<?php
return [
    'auth'  => [
        'register'  => [
            'register'  => 'register',
            'Personal details'  => 'détailles personnel',
            'Account Details'   => 'détailles du compte',
            'registered'        => "s'enregistré",
        ],
        'login' => [
            'login' => 'login',
            "I don't have an account yet" => "J'ai pas encore de compte ;)",
            "Forgot your password"  => "Mot de passe oublier ?",
            "don't active" => "votre Compte n'est pas active veuillez contacter votre compagnie ou appeler le support technique"
        ],
        'logout' => 'déconnexion',
        'pswr' => [
            'email' => [
                'title' => 'Password Reset',
                "btn" => "Reset my password",
                "text"  => "j'ai oublier mon mot de passe"
            ],
            'send' => [
               'subject'    => 'Modifier mon mot de passe',
                'line1'     => 'Suite a votre demande de reinitialisation du mot de passe de votre compte LYTheGround',
                'line2'     => 'Ce message vous a été envoyer suite a la tentative de votre mot de passe!',
                'action'    => 'Modifié mon mot de passe',
                "salutation" => 'Cordialement',
                "greeting"  => "Bonjour"
            ],
            'reset' => [
                'title' => 'change password',
                "btn" => "change password",
                "text"  => "votre précédent mot de passe sera supprimé immédiatement"
            ]
        ],
    ],
    'rh' => [
        'user' => [
            'members'   => 'members',
            "profile" => "Profile",
            'params' => "réglage",
            'success_params' => 'vos information son mis a jours avec success',
            'range' => [
                'range_title' => 'Range',
                'range' => 'range',
                'range_danger' => 'Ce compte est inactivez veuillez ressayer après son activation.',
                'range_archived_danger' => 'Ce compte est Archivez veuillez ressayer après son activation.',
                'limit_left' => ':value jours d\'accès restant',
                'add_success' => 'Le range a été ajouter avec success'
            ],
            'status' => [
                'danger_bloque' => "le status est bloquez j'usque :value",
                "danger_pdg" => "Le Status du compte de PDG Doit toujours être actif",
                'modal_update' => "<p>L'inactivation ou l'archivation du status des comptes est assez strict, le retour sur votre choix ne sera pas immédiat</p>
                                <p>Le nombre des jours minimum de l'inactivation d'un compte est : <span class='text-danger'>7 jours</span></p>
                                <p>Le nombre des jours minimum de l'archivation d'un compte est : <span class='text-danger'>20 jours</span></p>
                                <p>Veuillez étudier soigneusement les conséquences de votre Choix</p>",
            ]

        ],
        'position' => [
            'position'      => 'position',
            'index'         => ['title' => 'List des positions'],
            'create'        => ['title' => 'Ajouter une nouvelle Position'],
            'edit'          => ['title' => 'Modifier Position'],
            'show'          => ['title' => 'Position'],
            'edit_success'  => 'La position a été mis a jour avec succès',
            'modal_delete'  => '<p>La suppression de ce poste sera definitive</p><p>Veuillez étudier soigneusement les conséquences de votre Choix</p>'
        ],
    ],
    'premium' => [
        'statuses' => [
            'active' => 'active',
            'inactive' => 'inactive',
            'archived' => 'archived'
        ]
    ],
    'diver' => [
        'sure' => 'Vous être sûr ?'
    ],
    'product' => [
        'index' => ['title' => 'magasin'],
        'create' => [
            'title' => 'Création d\'un nouveau produit',
            'success'  => 'Le Produit a été Crée avec succès',
        ],
        'edit' => [
            'title' => 'Mis à jour ce produit',
            'success'  => 'Le Produit a été mis a jour avec succès',
        ],
        'delete' => [
            'danger'  => 'Ce Produit ne peux pas être supprimé il est engagé dans un (des) historique(s) de (des) vente(s) ou d\'achat(s)',
            'success'  => 'Le Produit a été supprimé avec succès',
            'modal_delete'  => '<p>La suppression de ce produit sera definitive</p><p>Veuillez étudier soigneusement les conséquences de votre Choix</p>',
            'modal_img_delete'  => '<p>La suppression de cette image sera definitive</p><p>Veuillez étudier soigneusement les conséquences de votre Choix</p>',
        ],
        'form'  => [
            'selectImg' => 'select img',
            'selectMsg' => 'Quatre images maximum, Type: .gif, .jpg, .png'
        ],
     ],
    'deal' => [
        'provider' => [
            'index' => ['title' => 'fournisseurs'],
            'create' => [
                'title'     => 'création d\'un nouveau Fournisseur',
                'success'   => 'un nouveau fournisseur a été ajouté avec succès'
                ],
            'edit' => [
                'title'     => 'Mis a jour ce Fournisseur',
                'success'   => 'le fournisseur a été mise a jour avec succès'
            ],
            'delete' => [
                'danger'  => 'Ce Fournisseur ne peux pas être supprimé il est engagé dans un (des) historique(s) d\'achat(s)',
                'success'  => 'Le Fournisseur a été supprimé avec succès',
                'modal_delete'  => '<p>La suppression de ce fournisseur sera definitive</p><p>Veuillez étudier soigneusement les conséquences de votre Choix</p>',
                ],
            ],
        'client' => [
            'index' => ['title' => 'clients'],
            'create' => [
                'title'     => 'création d\'un nouveau Client',
                'success'   => 'un nouveau Client a été ajouté avec succès'
                ],
            'edit' => [
                'title'     => 'Mis a jour ce Client',
                'success'   => 'le client a été mise a jour avec succès'
            ],
            'delete' => [
                'danger'  => 'Ce Client ne peux pas être supprimé il est engagé dans un (des) historique(s) de(s) vente(s)',
                'success'  => 'Le Client a été supprimé avec succès',
                'modal_delete'  => '<p>La suppression de ce client sera definitive</p><p>Veuillez étudier soigneusement les conséquences de votre Choix</p>',
                ],
            ]
    ],
    'trade' => [
        'in progress' => 'encours',
        'finish' => 'fini',
        'archived' => 'archivez',
        'buy' => [
            'index' => ['title' => 'achats'],
            'create' => [
                'title'     => 'création d\'un nouveau Achat',
                'success'   => 'un nouveau achat a été ajouté avec succès'
            ],
            'delete' => [
                'danger'  => 'Vous avez pas les autorisation nécessaire pour supprimé cette achat',
                'success'  => 'L\'Achat a été supprimé avec succès',
                'modal_delete'  => '<p>La suppression de cet achat sera definitive</p><p>Veuillez étudier soigneusement les conséquences de votre Choix</p>',
            ]
        ],
        'sale' => [
            'index' => ['title' => 'Ventes'],
            'create' => [
                'title'     => 'création d\'une nouvel vente',
                'success'   => 'une nouvel vente a bien été créer avec succès'
            ],
            'delete' => [
                'danger'  => 'Vous n\'avez malheureusement pas les autorisations nécessaire pour supprimé cette vente',
                'success'  => 'La vente a bien été supprimé avec succès',
                'modal_delete'  => '<p>La suppression de cette vente sera définitive</p><p>Veuillez étudier soigneusement les conséquences de votre Choix</p>',
            ],
            'release' => [
                'title' => 'liste des vente non Confirmé'
            ]
        ],
        'bc' => 'Bon de Commande',
        'dv' => [
            'create' => [
                'title' => 'Création d\'un nouvel Devi',
                'success' => 'Le devi bien a été ajouté avec succès',
                'danger' => 'Tous les prix unitaire doit être indiquez'
            ],
            'delete' => [
                'success' => 'Le devi a été supprimé avec succès',
                'danger'    => 'Ce devi ne peux être supprimé il est déjà Confirmé.'
            ],
            'confirm' => [
                'success' => 'Le devi a été confirmé avec succès'
            ]
        ],
        'bl'    => [
            'select' => 'Ajouté le Bon de commande'
        ],
        'fc'    => [
            'select' => 'Ajouté la facture'
        ],
    ],
    'money' => [
        'unload' => [
            'delete_success' => 'la décharge a bien été supprimé',
            'edit_success' => 'la décharge a bien été modifier',
            'create_success' => 'la décharge a bien été crée',
        ],
    ]
];
