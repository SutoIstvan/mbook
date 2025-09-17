<?php
return [
    'required' => 'A(z) :attribute mező kitöltése kötelező.',
    
    'min' => [
        'string' => 'A(z) :attribute legalább :min karakter hosszú kell legyen.',
    ],

    'max' => [
        'string' => 'A(z) Megjegyzés nem lehet hosszabb, mint :max karakter.',
    ],

    'attributes' => [
        'name' => 'név',
        'birth_date' => 'születési dátum',
        'death_date' => 'halálozási dátum',
        'biography' => 'életrajz',
        'photo' => 'emlékkép',
    ],

    'confirmed' => 'A(z) :attribute megerősítése nem egyezik.',
];
