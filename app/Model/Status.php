<?php

class Status extends AppModel {

    public $useTable = 'status';

    public $hasMany = array(
        'PrestadorServico' => array(
            'className' => 'PrestadorServico',
            'foreignKey' => 'status_id'
        )
    );
}
