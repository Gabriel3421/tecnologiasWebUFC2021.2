function deletarCliente(cod) {

    if (confirm('Você tem certeza que deseja deletar este cliente?')) {
        $.post("../include/deletarRegistros.php",
            {
                idClienteDeletar: cod
            },
            function (valor) {
                $("#mensagem").html(valor);
            }
        );
    }
}
function deletarPet(cod) {
    if (confirm('Você tem certeza que deseja deletar este pet?')) {
        $.post("../include/deletarRegistros.php",
            {
                idPetDeletar: cod
            },
            function (valor) {
                $("#mensagem").html(valor);
            }
        );
    }
}
function deletarConsulta(cod) {
    if (confirm('Você tem certeza que deseja deletar esta consulta?')) {
        $.post("../include/deletarRegistros.php",
            {
                idConsultaDeletar: cod
            },
            function (valor) {
                $("#mensagem").html(valor);
            }
        );
    }
}

function buscarPetsPorCliente(cod) {
    console.log('aki');
    window.location.href = window.location.pathname + "?rota=cadastrar_consulta&id_cliente=" + cod;
}