<?php
if (isset($_SESSION['administrador'])) {
    $objPet = new Pet();
    if (isset($_GET['id'])) {
        $objPet->selecionarPorId($_GET['id']);
    }
    $retorno = $objPet->retornoBD->fetch_object();
    $objCliente = new Cliente();
    $objCliente->selecionarClientes();
?>
    <div class="container">
        <div class="row">
            <div class="col-10">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome-pet" aria-describedby="nomeHelp" name="nomePet" value="<?php echo $retorno->nome_pet; ?>">
                        <div id="nomeHelp" class="form-text"></div>
                    </div>

                    <div class="mb-3">
                        <label for="dono" class="form-label">Dono</label>
                        <select class="form-control" id="dono-pet" aria-describedby="donoHelp" name="donoPet">
                            <option value="" selected disabled>Selecione o dono</option>
                            <?php
                            while ($retornoCliente = $objCliente->retornoBD->fetch_object()) {
                                if ($retornoCliente->id_cliente ===  $retorno->cliente_id) {
                                    echo '<option value="' . $retornoCliente->id_cliente . '" selected >' . $retornoCliente->nome_cliente . '</option>';
                                } else {
                                    echo '<option value="' . $retornoCliente->id_cliente . '">' . $retornoCliente->nome_cliente . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <div id="dono" class="form-text"></div>
                    </div>
                    <input type="hidden" value="<?php echo $retorno->id_pet; ?>" name="idPet">
                    <input type="hidden" name="formEditarPet">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>


            </div>
        </div>
    </div>
<?php
} else {
    header("Location:../index.html");
}
?>