<?php

class Prestador extends AppModel {

    public $useTable = 'prestadores';

    public $hasMany = array(
        'PrestadorServico' => array(
            'className' => 'PrestadorServico',
            'foreignKey' => 'prestador_id'
        )
    );
}
