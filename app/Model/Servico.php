<?php

class Servico extends AppModel {

    public $useTable = 'servicos';

    public $hasMany = array(
        'PrestadorServico' => array(
            'className' => 'PrestadorServico',
            'foreignKey' => 'servico_id'
        )
    );
}
