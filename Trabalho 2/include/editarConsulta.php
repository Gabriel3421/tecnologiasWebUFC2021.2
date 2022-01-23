<?php
if (isset($_SESSION['administrador'])) {
    $objConsulta = new Consulta();
    if (isset($_GET['id'])) {
        $objConsulta->selecionarPorId($_GET['id']);
    }
    $retorno = $objConsulta->retornoBD->fetch_object();
    $objCliente = new Cliente();
    $objCliente->selecionarPorId($retorno->cliente_id);
    $nomeCliente = $objCliente->retornoBD->fetch_object()->nome_cliente;
    $objPet = new Pet();
    $objPet->selecionarPorDono($retorno->cliente_id);
    if ($objCliente->retornoBD != null) {
?>
        <div class="container">
            <div class="row">
                <div class="col-10">
                    <form method="POST" action="">

                        <div class="mb-3">
                            <label for="cliente" class="form-label">Cliente</label>
                            <input type="text" disabled class="form-control" id="cliente" aria-describedby="clienteHelp" value="<?php echo $nomeCliente ?>">
                            <div id="clienteHelp" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="pet" class="form-label">Pet</label>
                            <select class="form-control" id="pet-id" aria-describedby="petHelp" name="petConsulta" required>
                                <option value="" selected disabled>Selecione o pet</option>
                                <?php
                                while ($retornoPet = $objPet->retornoBD->fetch_object()) {
                                    if (($retorno->pet_id == $retornoPet->id_pet)) {
                                        echo '<option value="' . $retornoPet->id_pet . '" selected >' . $retornoPet->nome_pet . '</option>';
                                    } else {
                                        echo '<option value="' . $retornoPet->id_pet . '">' . $retornoPet->nome_pet . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <div id="pet" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="data" class="form-label">Data</label>
                            <input type="date" min="<?php date("Y-m-d") ?>" class="form-control" id="data" aria-describedby="dataHelp" name="dataConsulta" required value="<?php echo $retorno->data; ?>">
                            <div id="dataHelp" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="hora" class="form-label">Hora</label>
                            <input type="time" min="09:00" max="18:00" class="form-control" id="hora" aria-describedby="horaHelp" name="horaConsulta" required value="<?php echo $retorno->hora; ?>">
                            <div id="horaHelp" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="observacao" class="form-label">Observações</label>
                            <input type="text" class="form-control" id="observacao" aria-describedby="observacaoHelp" name="observacaoConsulta" required value="<?php echo $retorno->observacoes; ?>">
                            <div id="observacaoHelp" class="form-text"></div>
                        </div>
                        <input type="hidden" value="<?php echo $retorno->id_consulta; ?>" name="idConsulta">
                        <input type="hidden" value="<?php echo $retorno->cliente_id ?>" name="clienteConsulta">
                        <input type="hidden" name="formEditarConsulta">
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