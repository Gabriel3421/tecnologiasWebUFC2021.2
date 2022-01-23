<?php
include_once("../classes/Cliente.php");
include_once("../classes/Pet.php");
include_once("../classes/Consulta.php");
//Get
if (isset($_GET['rota'])) {
    switch ($_GET['rota']) {
        case "cadastrar_cliente":
            include("../include/cadastrarCliente.php");
            break;

        case "visualizar_cliente":
            include("../include/visualizarCliente.php");
            break;

        case "editar_cliente":
            include("../include/editarCliente.php");
            break;

        case "cadastrar_pet":
            include("../include/cadastrarPet.php");
            break;

        case "visualizar_pet":
            include("../include/visualizarPet.php");
            break;

        case "editar_pet":
            include("../include/editarPet.php");
            break;

        case "cadastrar_consulta":
            include("../include/cadastrarConsulta.php");
            break;

        case "visualizar_consulta":
            include("../include/visualizarConsulta.php");
            break;

        case "editar_consulta":
            include("../include/editarConsulta.php");
            break;

        default:
            include("../include/dashboard.php");
            break;
    }
} else {
    include("../include/dashboard.php");
}


//Post
if (isset($_POST['formCadastrarCliente'])) {
    $objCliente = new Cliente();
    $objCliente->setNome($_POST['nomeCliente']);
    $objCliente->setCPF($_POST['cpfCliente']);
    $objCliente->setEmail($_POST['emailCliente']);
    $objCliente->setCelular($_POST['celularCliente']);
    $objCliente->setEndereco($_POST['enderecoCliente']);
    $objCliente->cadastrar();
} else if (isset($_POST['formEditarCliente'])) {
    $objCliente = new Cliente();
    $objCliente->setNome($_POST['nomeCliente']);
    $objCliente->setCPF($_POST['cpfCliente']);
    $objCliente->setEmail($_POST['emailCliente']);
    $objCliente->setCelular($_POST['celularCliente']);
    $objCliente->setEndereco($_POST['enderecoCliente']);
    $objCliente->setID($_POST['idCliente']);
    $objCliente->editar();
} else if (isset($_POST['formCadastrarPet'])) {
    $objPet = new Pet();
    $objPet->setNome($_POST['nomePet']);
    $objPet->setDono($_POST['donoPet']);
    $objPet->cadastrar();
} else if (isset($_POST['formEditarPet'])) {
    $objPet = new Pet();
    $objPet->setNome($_POST['nomePet']);
    $objPet->setDono($_POST['donoPet']);
    $objPet->setID($_POST['idPet']);
    $objPet->editar();
} else if (isset($_POST['formCadastrarConsulta'])) {
    $objConsulta = new Consulta();
    $objConsulta->setCliente_id($_POST['clienteConsulta']);
    $objConsulta->setData($_POST['dataConsulta']);
    $objConsulta->setHora($_POST['horaConsulta']);
    $objConsulta->setObservacoes($_POST['observacaoConsulta']);
    $objConsulta->setPet_id($_POST['petConsulta']);
    $objConsulta->cadastrar();
} else if (isset($_POST['formEditarConsulta'])) {
    $objConsulta = new Consulta();
    $objConsulta->setCliente_id($_POST['clienteConsulta']);
    $objConsulta->setData($_POST['dataConsulta']);
    $objConsulta->setHora($_POST['horaConsulta']);
    $objConsulta->setObservacoes($_POST['observacaoConsulta']);
    $objConsulta->setPet_id($_POST['petConsulta']);
    $objConsulta->setID($_POST['idConsulta']);
    $objConsulta->editar();
}
