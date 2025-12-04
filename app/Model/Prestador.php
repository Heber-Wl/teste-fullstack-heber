<?php

class Prestador extends AppModel {

    public $useTable = 'prestadores';

    public $hasMany = array(
        'PrestadorServico' => array(
            'className' => 'PrestadorServico',
            'foreignKey' => 'prestador_id'
        )
    );

    public $validate = [
        'nome' => [
            'rule' => 'notBlank',
            'message' => 'Informe o nome.'
        ],
        'telefone' => [
            'rule' => 'notBlank',
            'message' => 'Informe um telefone válido.'
        ],
        'foto' => [
            'rule' => 'notBlank',
            'allowEmpty' => true
        ],
        'email' => [
            'rule' => 'email',
            'message' => 'Informe um e-mail válido.'
        ],
        'password' => [
            'rule' => 'notBlank',
            'message' => 'Informe uma senha.'
        ],
        'ativo' => [
            'rule' => 'boolean',
            'message' => 'Valor inválido'
        ],
    ];
}
