<?php
class ServicoSeedShell extends AppShell {

    public $uses = array('Servico');

    public function main() {

        $this->out("Inserindo serviços...");

        $servicos = array(
            'Pedreiro',
            'Encanador',
            'Eletricista',
            'Pintor',
            'Jardineiro',
            'Diarista',
            'Babá',
            'Cabelereiro',
            'Manicure',
            'Massagista',
            'Montador de Móveis',
            'Técnico de Informática',
            'Frete e Carretos',
            'Chaveiro',
            'Gesseiro',
            'Serralheiro',
            'Marceneiro',
            'Refrigeração (Ar-condicionado)',
            'Instalador de TV',
            'Dedetizador',
            'Reformas e Construção',
            'Vidraceiro',
            'Paisagista',
            'Motorista Particular',
            'Professor Particular',
            'Cuidador de Idosos',
            'Lavador de Sofá',
            'Lavador de Carro',
            'Personal Trainer',
            'Nutricionista',
            'Psicólogo',
            'Design Gráfico',
            'Programador',
            'Desenvolvedor Web',
            'Social Media',
            'Editor de Vídeo',
            'Fotógrafo',
            'Filmaker',
            'DJ',
            'Locutor',
            'Decorador de Festas',
            'Organizador de Eventos',
            'Garçom / Bartender',
            'Segurança / Vigilante',
            'Zelador',
            'Instalador de Câmeras (CFTV)',
            'Instalador de Portão Eletrônico',
            'Consertos de Celular',
            'Assistência Técnica de Notebook',
            'Reparos em Eletrodomésticos',
            'Lavador de Tapetes',
            'Passeador de Cães',
            'Adestrador de Cães',
            'Ferramentaria',
            'Consultoria Financeira',
            'Contador',
            'Advogado',
            'Arquitetura',
            'Engenharia Civil',
            'Mecânico Automotivo',
            'Borracheiro',
            'Funilaria e Pintura Automotiva',
            'Soldador',
            'Telemarketing',
            'Cuidador Infantil (Babá nível Pro)',
            'Costureira',
            'Bordadeira',
            'Alfaiate',
            'Designer de Sobrancelhas',
            'Maquiadora',
            'Depiladora',
            'Esteticista'
        );

        foreach ($servicos as $servico) {
            $this->Servico->create();
            $this->Servico->save(array(
                'descricao' => $servico,
                'ativo' => 1
            ));
        }

        $this->out("Seeder de serviços concluída!");
    }
}
