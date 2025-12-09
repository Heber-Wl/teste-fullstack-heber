<?php
class Admin extends AppModel {

    public $useTable = 'admins';

    public $validate = [
        'nome' => [
            'rule' => 'notBlank',
            'message' => 'O nome é obrigatório.'
        ],
        'email' => [
            'email' => [
                'rule' => 'email',
                'message' => 'Informe um email válido.'
            ],
            'notBlank' => [
                'rule' => 'notBlank',
                'message' => 'O email é obrigatório.'
            ]
        ],
        'senha' => [
            'notBlank' => [
                'rule' => 'notBlank',
                'message' => 'A senha é obrigatória.'
            ]
        ],
        'ativo' => [
            'boolean' => [
                'rule' => 'boolean',
                'message' => 'Valor inválido para ativo.'
            ]
        ]
    ];
}
