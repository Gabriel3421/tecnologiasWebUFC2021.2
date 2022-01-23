<?php
if (isset($_SESSION['administrador'])) {
    $objCliente = new Cliente();
    $objCliente->selecionarClientes();
    if ($objCliente->retornoBD != null) {
?>
        <div class="container">
            <div class="row">
                <div class="col-10">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome-pet" aria-describedby="nomeHelp" name="nomePet">
                            <div id="nomeHelp" class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="dono" class="form-label">Dono</label>
                            <select class="form-control" id="dono-pet" aria-describedby="donoHelp" name="donoPet">
                                <option value="" selected disabled>Selecione o dono</option>
                                <?php
                                while ($retorno = $objCliente->retornoBD->fetch_object()) {
                                    echo '<option value="' . $retorno->id_cliente . '">' . $retorno->nome_cliente . '</option>';
                                }
                                ?>
                            </select>
                            <div id="dono" class="form-text"></div>
                        </div>

                        <input type="hidden" name="formCadastrarPet">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>


                </div>
            </div>
        </div>
<?php
    } else {
        echo "<script>alert('Falha ao buscar Clientes/Donos!')</script>";
    }
} else {
    header("Location:../index.html");
}
?>