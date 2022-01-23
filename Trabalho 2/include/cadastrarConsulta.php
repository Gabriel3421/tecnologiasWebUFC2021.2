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
                            <label for="cliente" class="form-label">Cliente</label>
                            <select onchange="buscarPetsPorCliente(this.value)" class="form-control" id="cliente-pet" aria-describedby="clienteHelp" name="clienteConsulta" required>
                                <option value="" selected disabled>Selecione o cliente</option>
                                <?php
                                while ($retornoCliente = $objCliente->retornoBD->fetch_object()) {
                                    if ((isset($_GET['id_cliente']) && $retornoCliente->id_cliente == $_GET['id_cliente'])) {
                                        echo '<option value="' . $retornoCliente->id_cliente . '" selected >' . $retornoCliente->nome_cliente . '</option>';
                                    } else {
                                        echo '<option value="' . $retornoCliente->id_cliente . '">' . $retornoCliente->nome_cliente . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <div id="cliente" class="form-text"></div>
                        </div>

                        <?php if (isset($_GET['id_cliente'])) {
                            $objPet = new Pet();
                            $objPet->selecionarPorDono($_GET['id_cliente']);
                        ?>
                            <div class="mb-3">
                                <label for="pet" class="form-label">Pet</label>
                                <select class="form-control" id="pet-id" aria-describedby="petHelp" name="petConsulta" required>
                                    <option value="" selected disabled>Selecione o pet</option>
                                    <?php
                                    while ($retornoPet = $objPet->retornoBD->fetch_object()) {
                                        echo '<option value="' . $retornoPet->id_pet . '">' . $retornoPet->nome_pet . '</option>';
                                    }
                                    ?>
                                </select>
                                <div id="pet" class="form-text"></div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="mb-3">
                            <label for="data" class="form-label">Data</label>
                            <input type="date" value="<?php date("Y-m-d") ?>" min="<?php date("Y-m-d") ?>" class="form-control" id="data" aria-describedby="dataHelp" name="dataConsulta" required>
                            <div id="dataHelp" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="hora" class="form-label">Hora</label>
                            <input type="time" min="09:00" max="18:00" class="form-control" id="hora" aria-describedby="horaHelp" name="horaConsulta" required>
                            <div id="horaHelp" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="observacao" class="form-label">Observações</label>
                            <input type="text" class="form-control" id="observacao" aria-describedby="observacaoHelp" name="observacaoConsulta" required>
                            <div id="observacaoHelp" class="form-text"></div>
                        </div>

                        <input type="hidden" name="formCadastrarConsulta">
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