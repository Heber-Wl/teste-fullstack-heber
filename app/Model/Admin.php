<?php
class Admin extends AppModel {

    public $useTable = 'admins';

    public $validate = [
        'nome' => [
            'notEmpty' => [
                'rule' => 'notEmpty',
                'message' => 'O nome é obrigatório.'
            ]
        ],
        'email' => [
            'email' => [
                'rule' => 'email',
                'message' => 'Informe um email válido.'
            ],
            'notEmpty' => [
                'rule' => 'notEmpty',
                'message' => 'O email é obrigatório.'
            ]
        ],
        'password' => [
            'notEmpty' => [
                'rule' => 'notEmpty',
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
