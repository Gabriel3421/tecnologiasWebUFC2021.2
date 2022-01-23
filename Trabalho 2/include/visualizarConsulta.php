<?php
include_once("../classes/Cliente.php");
include_once("../classes/Pet.php");
include_once("../classes/Consulta.php");

if (isset($_SESSION['administrador'])) {
?>
    <div class="row">
        <div class="col-lg-6">
            <!-- Collapsable Card Example -->
            <div class="card shadow mb-8">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Pesquisar Consultas</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="data" class="form-label">Data</label>
                                <input type="date" value="<?php date("Y-m-d") ?>" class="form-control" id="data" aria-describedby="dataHelp" name="dataConsulta" required>
                                <div id="dataHelp" class="form-text"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $objConsulta = new Consulta();
    $objPet = new Pet();
    $objCliente = new Cliente();

    if (isset($_GET['id'])) {
        $objConsulta->selecionarPorId($_GET['id']);
    } else if (isset($_POST['dataConsulta'])) {
        if (empty($_POST['dataConsulta'])) {
            $objConsulta->selecionarConsultas();
        } else {
            $objConsulta->selecionarPorData($_POST['dataConsulta']);
        }
    } else {
        $objConsulta->selecionarConsultas();
    }
    if ($objConsulta->retornoBD != null) {
    ?>
        <br />
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-hover">
                    <tr>
                        <th width="5%">#</th>
                        <th width="17%">Data</th>
                        <th width="17%">Hora</th>
                        <th width="17%">Observação</th>
                        <th width="17%">Cliente</th>
                        <th width="17%">Pet</th>
                        <th width="5%">Editar</th>
                        <th width="5%">Deletar</th>
                    </tr>

                    <?php

                    while ($retorno = $objConsulta->retornoBD->fetch_object()) {
                        $objCliente->selecionarPorId($retorno->cliente_id);
                        $objPet->selecionarPorId($retorno->pet_id);
                        $nomeCliente;
                        if ($objCliente->retornoBD != null) {
                            $nomeCliente = $objCliente->retornoBD->fetch_object()->nome_cliente;
                        } else {
                            $nomeCliente =  $retorno->cliente_id;
                        }
                        $nomePet;
                        if ($objPet->retornoBD != null) {
                            $nomePet = $objPet->retornoBD->fetch_object()->nome_pet;
                        } else {
                            $nomePet =  $retorno->pet_id;
                        }

                        echo '<tr><td>' . $retorno->id_consulta . '</td>
                        <td>' . $retorno->data . '</td>
                        <td>' . $retorno->hora . '</td>
                        <td>' . $retorno->observacoes . '</td>
                        <td>' . $nomeCliente . '</td>
                        <td>' . $nomePet . '</td>';

                        echo '<td><a href="?rota=editar_consulta&id=' . $retorno->id_consulta . '" class="btn btn-info btn-circle btn-sm"><i class="fas fa-list"></i></a></td>';
                        echo '<td><a href="#" class="btn btn-danger btn-circle btn-sm" onclick=\'deletarConsulta("' . $retorno->id_consulta . '")\';><i class="fas fa-trash"></i></a></td></tr>';
                    }

                    ?>
                </table>
            </div>
        </div>
<?php
    }
} else {
    header("Location:../index.php");
}
?>