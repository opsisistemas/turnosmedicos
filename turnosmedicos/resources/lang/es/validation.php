<?php

return [

    /*
    |--------------------------------------------------------------------------
    | v&aacute;lidaation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contener the default error messages used by
    | the v&aacute;lidaator class. Some of these rules tener multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'El :attribute debe ser aceptado.',
    'active_url'           => 'El :attribute no representa una URL v&aacute;lida.',
    'after'                => 'El :attribute debe ser una fecha posterior a :date.',
    'alpha'                => 'El :attribute s&oacute;lo debe contener letras.',
    'alpha_dash'           => 'El :attribute s&oacute;lo debe contener letras, n&uacute;meros, y guiones.',
    'alpha_num'            => 'El :attribute s&oacute;lo debe contener letras y n&uacute;meros.',
    'array'                => 'El :attribute debe ser un arreglo.',
    'before'               => 'El :attribute debe ser una fecha anterior :date.',
    'between'              => [
        'numeric' => 'El :attribute debe estar entre :min y :max.',
        'file'    => 'El :attribute debe estar entre :min y :max kilobytes.',
        'string'  => 'El :attribute debe estar entre :min y :max caracateres.',
        'array'   => 'El :attribute debe tener entre :min y :max items.',
    ],
    'boolean'              => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed'            => 'El :attribute confirmaci&oacute;n no coincide.',
    'date'                 => 'El :attribute no es una fecha v&aacutelida.',
    'date_format'          => 'El :attribute no corresponde al format :format.',
    'different'            => 'El :attribute y :other deben ser diferentes.',
    'digits'               => 'El :attribute debe ser de :digits d&iacute;gitos.',
    'digits_between'       => 'El :attribute debe estar entre :min y :max d&iacute;gitos.',
    'distinct'             => 'El campo :attribute tiene un valor duplicado.',
    'email'                => 'El :attribute debe ser una direcci&oacute;n de correo v&aacute;lida.',
    'exists'               => 'El :attribute seleccionado is inv&aacute;lido.',
    'filled'               => 'El campo :attribute is requerido.',
    'image'                => 'El :attribute debe ser una imagen.',
    'in'                   => 'El :attribute seleccionado is inv&aacute;lido.',
    'in_array'             => 'El campo :attribute no existe en in :other.',
    'integer'              => 'El :attribute debe ser un n&uacute;mero entero.',
    'ip'                   => 'El :attribute debe ser una direcci&oacute;n v&aacute;lida.',
    'json'                 => 'El :attribute debe ser una cadena JSON v&aacute;lida.',
    'max'                  => [
        'numeric' => 'El :attribute no debe ser mayor que :max.',
        'file'    => 'El :attribute no debe ser mayor que :max kilobytes.',
        'string'  => 'El :attribute no debe ser mayor que :max caracateres.',
        'array'   => 'El :attribute no debe tener mas de :max items.',
    ],
    'mimes'                => 'El :attribute debe ser un archivo de tipo: :values.',
    'min'                  => [
        'numeric' => 'El :attribute debe ser al menos :min.',
        'file'    => 'El :attribute debe ser al menos :min kilobytes.',
        'string'  => 'El :attribute debe ser al menos :min caracateres.',
        'array'   => 'El :attribute debe tener al menos :min items.',
    ],
    'not_in'               => 'El :attribute seleccionado es inv&aacute;lido.',
    'numeric'              => 'El :attribute debe ser un n&uacute;mero.',
    'present'              => 'El campo :attribute debe estar presente.',
    'regex'                => 'El formato del :attribute es inv&aacute;lido.',
    'required'             => 'El campo :attribute es requerido.',
    'required_if'          => 'El campo :attribute es requerido cuando :other es :value.',
    'required_unless'      => 'El campo :attribute es requerido a menos que :other est&eacute; en :values.',
    'required_with'        => 'El campo :attribute es requerido cuando :values est&aacute; presente.',
    'required_with_all'    => 'El campo :attribute es requerido cuando :values est&aacute; presente.',
    'required_without'     => 'El campo :attribute es requerido cuando :values no est&aacute; presente.',
    'required_without_all' => 'El campo :attribute es requerido cuando ninguno de los :values est&aacute;n presentes.',
    'same'                 => 'El :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El :attribute debe ser :size.',
        'file'    => 'El :attribute debe ser :size kilobytes.',
        'string'  => 'El :attribute debe ser :size caracateres.',
        'array'   => 'El :attribute debe contener :size items.',
    ],
    'string'               => 'El :attribute debe ser una cadena.',
    'timezone'             => 'El :attribute debe ser una zona v&aacute;lida.',
    'unique'               => 'El :attribute ya fue seleccionado.',
    'url'                  => 'El formato del :attribute es inv&aacute;lido.',

    /*
    |--------------------------------------------------------------------------
    | Custom v&aacute;lidaation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom v&aacute;lidaation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom v&aacute;lidaation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
