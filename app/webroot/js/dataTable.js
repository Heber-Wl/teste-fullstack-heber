$(document).ready(function() {
    $('#tabela-prestadores').DataTable({
        responsive: true,
        paging: true,        // ✔️ paginação ativada
        pageLength: 10,      // quantidade por página
        lengthChange: true,  // permite mudar quantidade
        info: true,          // mostra "mostrando X de Y"
        searching: true,     // busca
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando _START_ até _END_ de _TOTAL_ registros",
            zeroRecords: "Nenhum registro encontrado.",
            infoEmpty: "Nenhum registro disponível",
            paginate: {
                first: "Primeiro",
                last: "Último",
                next: "Próximo",
                previous: "Anterior"
            }
        }
    });
});