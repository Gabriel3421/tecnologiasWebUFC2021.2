<?php
include_once("../classes/Cliente.php");
include_once("../classes/Pet.php");
include_once("../classes/Consulta.php");

if (isset($_POST['idClienteDeletar'])) {
    $objCliente = new Cliente();
    $objCliente->deletar($_POST['idClienteDeletar']);
}
if (isset($_POST['idPetDeletar'])) {
    $objPet = new Pet();
    $objPet->deletar($_POST['idPetDeletar']);
}
if (isset($_POST['idConsultaDeletar'])) {
    $objConsulta = new Consulta();
    $objConsulta->deletar($_POST['idConsultaDeletar']);
}
