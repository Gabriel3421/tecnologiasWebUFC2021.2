<?php
include_once("../classes/Cliente.php");
include_once("../classes/Pet.php");
if (isset($_SESSION['administrador'])) {
?>
    <div class="row">
        <div class="col-lg-6">
            <!-- Collapsable Card Example -->
            <div class="card shadow mb-8">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Pesquisar Pets</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome-pet" aria-describedby="nomeHelp" name="nomePet">
                                <div id="nome" class="form-text"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $objPet = new Pet();
    $objCliente = new Cliente();

    if (isset($_GET['id'])) {
        $objPet->selecionarPorId($_GET['id']);
    } else if (isset($_POST['nomePet'])) {
        if (empty($_POST['nomePet'])) {
            $objPet->selecionarPets();
        } else {
            $objPet->selecionarPorNome($_POST['nomePet']);
        }
    } else {
        $objPet->selecionarPets();
    }
    if ($objPet->retornoBD != null) {
    ?>
        <br />
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-hover">
                    <tr>
                        <th width="5%">#</th>
                        <th width="32.5%">Nome</th>
                        <th width="32.5%">Dono</th>
                        <th width="10%">Editar</th>
                        <th width="10%">Deletar</th>
                    </tr>

                    <?php

                    while ($retorno = $objPet->retornoBD->fetch_object()) {
                        $objCliente->selecionarPorId($retorno->cliente_id);
                        $nomeCliente;
                        if ($objPet->retornoBD != null) {
                            $nomeCliente = $objCliente->retornoBD->fetch_object()->nome_cliente;
                        } else {
                            $nomeCliente =  $retorno->cliente_id;
                        }

                        echo '<tr><td>' . $retorno->id_pet . '</td><td>' .
                            $retorno->nome_pet . '</td><td>' .
                            $nomeCliente . '</td>';

                        echo '<td><a href="?rota=editar_pet&id=' . $retorno->id_pet . '" class="btn btn-info btn-circle btn-sm"><i class="fas fa-list"></i></a></td>';
                        echo '<td><a href="#" class="btn btn-danger btn-circle btn-sm" onclick=\'deletarPet("' . $retorno->id_pet . '")\';><i class="fas fa-trash"></i></a></td></tr>';
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