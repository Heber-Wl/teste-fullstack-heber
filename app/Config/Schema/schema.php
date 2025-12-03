<?php
class AppSchema extends CakeSchema {

    public $admins = array(
        'id' => array('type' => 'integer', 'key' => 'primary'),
        'nome' => array('type' => 'string', 'length' => 100, 'null' => false),
        'email' => array('type' => 'string', 'length' => 150, 'null' => false),
        'senha' => array('type' => 'string', 'length' => 255, 'null' => false),
        'created' => array('type' => 'datetime', 'null' => false),
        'modified' => array('type' => 'datetime', 'null' => false),
    );

    public $status = array(
        'id' => array('type' => 'integer', 'key' => 'primary'),
        'descricao' => array('type' => 'string', 'length' => 255, 'null' => false),
        'ativo' => array('type' => 'boolean', 'default' => 1, 'null' => false),
        'created' => array('type' => 'datetime', 'null' => false),
        'modified' => array('type' => 'datetime', 'null' => false),
    );

    public $prestadores = array(
        'id' => array('type' => 'integer', 'key' => 'primary'),
        'nome' => array('type' => 'string', 'length' => 255, 'null' => false),
        'telefone' => array('type' => 'string', 'length' => 20, 'null' => true),
        'email' => array('type' => 'string', 'length' => 150, 'null' => true),
        'foto' => array('type' => 'string', 'length' => 255, 'null' => true),
        'password' => array('type' => 'string', 'length' => 255, 'null' => false),
        'ativo' => array('type' => 'boolean', 'default' => 1, 'null' => false),
        'created' => array('type' => 'datetime', 'null' => false),
        'modified' => array('type' => 'datetime', 'null' => false),
    );

    public $servicos = array(
        'id' => array('type' => 'integer', 'key' => 'primary'),
        'descricao' => array('type' => 'string', 'length' => 255, 'null' => false),
        'ativo' => array('type' => 'boolean', 'default' => 1, 'null' => false),
        'created' => array('type' => 'datetime', 'null' => false),
        'modified' => array('type' => 'datetime', 'null' => false),
    );

    public $prestador_servico = array(
        'id' => array('type' => 'integer', 'key' => 'primary'),
        'prestador_id' => array('type' => 'integer', 'null' => false),
        'servico_id' => array('type' => 'integer', 'null' => false),
        'valor' => array('type' => 'float', 'null' => false),
        'status_id' => array('type' => 'integer', 'null' => false),
        'created' => array('type' => 'datetime', 'null' => false),
        'modified' => array('type' => 'datetime', 'null' => false),
    );

}
