<?php

class PrestadorServico extends AppModel {

    public $useTable = 'prestador_servico';

    public $belongsTo = array(
        'Prestador' => array(
            'className' => 'Prestador',
            'foreignKey' => 'prestador_id'
        ),
        'Servico' => array(
            'className' => 'Servico',
            'foreignKey' => 'servico_id'
        ),
        'Status' => array(
            'className' => 'Status',
            'foreignKey' => 'status_id'
        )
    );
}
