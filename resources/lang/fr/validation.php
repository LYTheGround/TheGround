<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'             => 'Le champ :attribute doit être accepte.',
    'active_url'           => "Le champ :attribute n'est pas une URL valide.",
    'after'                => 'Le champ :attribute doit être une date posterieure au :date.',
    'after_or_equal'       => 'Le champ :attribute doit être une date posterieure ou egale au :date.',
    'alpha'                => 'Le champ :attribute doit contenir uniquement des lettres.',
    'alpha_dash'           => 'Le champ :attribute doit contenir uniquement des lettres, des chiffres et des tirets.',
    'alpha_num'            => 'Le champ :attribute doit contenir uniquement des chiffres et des lettres.',
    'array'                => 'Le champ :attribute doit être un tableau.',
    'before'               => 'Le champ :attribute doit être une date anterieure au :date.',
    'before_or_equal'      => 'Le champ :attribute doit être une date anterieure ou egale au :date.',
    'between'              => [
        'numeric' => 'La valeur de :attribute doit être comprise entre :min et :max.',
        'file'    => 'La taille du fichier de :attribute doit être comprise entre :min et :max kilo-octets.',
        'string'  => 'Le texte :attribute doit contenir entre :min et :max caractères.',
        'array'   => 'Le tableau :attribute doit contenir entre :min et :max elements.',
    ],
    'boolean'              => 'Le champ :attribute doit être vrai ou faux.',
    'confirmed'            => 'Le champ de confirmation :attribute ne correspond pas.',
    'date'                 => "Le champ :attribute n'est pas une date valide.",
    'date_format'          => 'Le champ :attribute ne correspond pas au format :format.',
    'different'            => 'Les champs :attribute et :other doivent être differents.',
    'digits'               => 'Le champ :attribute doit contenir :digits chiffres.',
    'digits_between'       => 'Le champ :attribute doit contenir entre :min et :max chiffres.',
    'dimensions'           => "La taille de l'image :attribute n'est pas conforme.",
    'distinct'             => 'Le champ :attribute a une valeur en double.',
    'email'                => 'Le champ :attribute doit être une adresse courriel valide.',
    'exists'               => 'Le champ :attribute selectionne est invalide.',
    'file'                 => 'Le champ :attribute doit être un fichier.',
    'filled'               => 'Le champ :attribute doit avoir une valeur.',
    'image'                => 'Le champ :attribute doit être une image.',
    'in'                   => 'Le champ :attribute est invalide.',
    'in_array'             => "Le champ :attribute n'existe pas dans :other.",
    'integer'              => 'Le champ :attribute doit être un entier.',
    'ip'                   => 'Le champ :attribute doit être une adresse IP valide.',
    'ipv4'                 => 'Le champ :attribute doit être une adresse IPv4 valide.',
    'ipv6'                 => 'Le champ :attribute doit être une adresse IPv6 valide.',
    'json'                 => 'Le champ :attribute doit être un document JSON valide.',
    'max'                  => [
        'numeric' => 'La valeur de :attribute ne peut être superieure à :max.',
        'file'    => 'La taille du fichier de :attribute ne peut pas depasser :max kilo-octets.',
        'string'  => 'Le texte de :attribute ne peut contenir plus de :max caractères.',
        'array'   => 'Le tableau :attribute ne peut contenir plus de :max elements.',
    ],
    'mimes'                => 'Le champ :attribute doit être un fichier de type : :values.',
    'mimetypes'            => 'Le champ :attribute doit être un fichier de type : :values.',
    'min'                  => [
        'numeric' => 'La valeur de :attribute doit être superieure ou egale à :min.',
        'file'    => 'La taille du fichier de :attribute doit être superieure à :min kilo-octets.',
        'string'  => 'Le texte :attribute doit contenir au moins :min caractères.',
        'array'   => 'Le tableau :attribute doit contenir au moins :min elements.',
    ],
    'not_in'               => "Le champ :attribute selectionne n'est pas valide.",
    'numeric'              => 'Le champ :attribute doit contenir un nombre.',
    'present'              => 'Le champ :attribute doit être present.',
    'regex'                => 'Le format du champ :attribute est invalide.',
    'required'             => 'Le champ :attribute est obligatoire.',
    'required_if'          => 'Le champ :attribute est obligatoire quand la valeur de :other est :value.',
    'required_unless'      => 'Le champ :attribute est obligatoire sauf si :other est :values.',
    'required_with'        => 'Le champ :attribute est obligatoire quand :values est present.',
    'required_with_all'    => 'Le champ :attribute est obligatoire quand :values est present.',
    'required_without'     => "Le champ :attribute est obligatoire quand :values n'est pas present.",
    'required_without_all' => "Le champ :attribute est requis quand aucun de :values n'est present.",
    'same'                 => 'Les champs :attribute et :other doivent être identiques.',
    'size'                 => [
        'numeric' => 'La valeur de :attribute doit être :size.',
        'file'    => 'La taille du fichier de :attribute doit être de :size kilo-octets.',
        'string'  => 'Le texte de :attribute doit contenir :size caractères.',
        'array'   => 'Le tableau :attribute doit contenir :size elements.',
    ],
    'string'               => 'Le champ :attribute doit être une chaîne de caractères.',
    'timezone'             => 'Le champ :attribute doit être un fuseau horaire valide.',
    'unique'               => 'La valeur du champ :attribute est dejà utilisee.',
    'uploaded'             => "Le fichier du champ :attribute n'a pu être televerse.",
    'url'                  => "Le format de l'URL de :attribute n'est pas valide.",
    // add
    'password'             => "Le mot de passe doit être melanger entre min,maj et chiffre",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes'           => [
        'name'                  => 'nom',
        'username'              => "nom d'utilisateur",
        'email'                 => 'adresse courriel',
        'first_name'            => 'prenom',
        'last_name'             => 'nom',
        'password'              => 'mot de passe',
        'password_confirmation' => 'confirmation du mot de passe',
        'city'                  => 'ville',
        'country'               => 'pays',
        'address'               => 'adresse',
        'phone'                 => 'telephone',
        'mobile'                => 'portable',
        'age'                   => 'âge',
        'sex'                   => 'sexe',
        'gender'                => 'genre',
        'day'                   => 'jour',
        'month'                 => 'mois',
        'year'                  => 'annee',
        'hour'                  => 'heure',
        'minute'                => 'minute',
        'second'                => 'seconde',
        'title'                 => 'titre',
        'content'               => 'contenu',
        'description'           => 'description',
        'excerpt'               => 'extrait',
        'date'                  => 'date',
        'time'                  => 'heure',
        'available'             => 'disponible',
        'size'                  => 'taille',
        // add
        'birth'                 => 'date de naissance',
        'identity'              => 'identite',
        'token'                 => 'token',
        'speaker'               => 'speaker',
        'cin'                   => 'numero cin',
        'birth-minor'           => 'vous ête mineur',
        'action'                => 'action',
        'create'                => 'Creer',
        'edit'                  => 'Modifier',
        'delete'                => 'Supprime',
        'close'                 => 'Fermer',
        'submit'                => 'Soumettre',
        'tva'                   => 'tva',
        'prince'                => 'prix',
        'chargeOn'              => 'Charger sur',
        'justify'               => 'pièce justificatif',
        'tva_payed'             => 'tva a paye',
        'tva_unload'            => 'tva apres les charges',
        'profit'                => 'profit',
        'taxes'                 => 'IS',
        'taxes_unload'          => 'IS apres les charges',
        'unload'                => 'les Charges',
        'profit_taxes'          => 'profit apres l\'IS',
        'image'                 => 'image',
        'status'                => 'status',
        'face'                  => 'face',
        'sold'                  => 'Sold',
        'homme'                 => 'Homme',
        'femme'                 => 'Femme',
        'img_inputs'            => 'Type d\'Images accepter: jpg, gif, png. Maximum :nbr images only.',
        'img_input'            => 'Type d\'Images accepter: jpg, gif, png.',
        'position'              => 'poste',
        'category'              => 'category',
        'qt_min'                => 'quantite minimale',
        'ref'                   => 'ref',
        'qt'                    => 'quantite',
        'amount'                => 'amount',
        'inconnu'               => 'inconnu',
        'fax'                   => 'fax',
        'apt_nbr'               => 'n°',
        'build'                 => 'immeuble',
        'floor'                 => 'etage',
        'zip'                   => 'code postal',
        'products'              => 'products',
        'progress'              => 'progresse',
        'ht'                    => 'ht',
        'ttc'                   => 'ttc',
        'search'                => 'recherche',
        'min_amount'            => 'prix le plus bas',
        'confirm'               => 'confirme',
        'add'                   => 'ajoute',
        'dv'                    => 'Devi',
        'dvs'                   => 'devis',
        'pu'                    => 'prix unitaire',
        'bc'                    => 'Bon de Commande',
        'selected'              => 'selectionne',
        'buyed'                 => 'achete',
        'delivery'              => 'livraison',
        'store'                 => 'stock',
        'finish'                => 'fini',
        'bl'                    => 'Bon de livraison',
        'fc'                    => 'Facture',
        'viewProfil'            => 'accede au profil',
        'total'                 => 'total',
        'activity'              => 'activite',
        'tasks_time'            => 'Le :date à :hour h et :min minutes',
        'buy_bc_task'           => 'a ajoute le bon de commande',
        'buy_dv_task'           => 'a confirme le devi',
        'buy_done_task'         => 'a confirme l\'achat',
        'buy_delivery_task'     => 'a livre la commande',
        'buy_store_task'        => 'a confirme la presence de la commande dans le stock',
        'buy_finish_task'       => 'a marquez l\'achat comme termine',
        'buy_bl_task'           => 'a uploader le bon de livraison',
        'buy_fc_task'           => 'a uploader la Facture',
        'upload'                => 'upload',
        'emptyList'             => 'La liste recherche est vide',
        'storeLeft'             => 'En Stock',
        'offerLeft'             => 'En Offre'
    ],

];
