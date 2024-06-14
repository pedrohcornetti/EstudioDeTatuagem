<?php
include 'navbar.php';
require 'funcao.php';
$conn = conectar();

// Processa a exclusão de clientes
if (isset($_POST['delete_id'])) {
    deleteCliente($conn, $_POST['delete_id']);
}

// Processa a atualização de clientes
if (isset($_POST['update_id'])) {
    updateCliente($conn, $_POST['update_id'], $_POST['nome'], $_POST['telefone'], $_POST['email']);
}

// Processa a adição de clientes
if (isset($_POST['add_cliente'])) {
    addCliente($conn, $_POST['nome'], $_POST['telefone'], $_POST['email']);
}
?>

<section>
    <h2>Clientes</h2>
    <ul class="list-group">
        <?php
        $clientes = getClientes($conn);
        if ($clientes !== null) {
            foreach ($clientes as $cliente): ?>
                <li class="list-group-item">
                    <?php echo $cliente['nome']; ?> - <?php echo $cliente['telefone']; ?> - <?php echo $cliente['email']; ?>
                    <form method="post" class="float-right">
                        <input type="hidden" name="delete_id" value="<?php echo $cliente['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                    <button class="btn btn-secondary btn-sm float-right mr-2" data-toggle="modal" data-target="#updateModal<?php echo $cliente['id']; ?>">Editar</button>

                    <!-- Modal de Edição -->
                    <div class="modal fade" id="updateModal<?php echo $cliente['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel<?php echo $cliente['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel<?php echo $cliente['id']; ?>">Editar Cliente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post">
                                    <div class="modal-body">
                                        <input type="hidden" name="update_id" value="<?php echo $cliente['id']; ?>">
                                        <div class="form-group">
                                            <label>Nome:</label>
                                            <input type="text" name="nome" class="form-control" value="<?php echo $cliente['nome']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Telefone:</label>
                                            <input type="text" name="telefone" class="form-control" value="<?php echo $cliente['telefone']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email:</label>
                                            <input type="email" name="email" class="form-control" value="<?php echo $cliente['email']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach;
        } else {
            echo "<li class='list-group-item'>Nenhum cliente encontrado.</li>";
        }
        ?>
    </ul>

    <form method="post" class="mt-3">
        <h3>Adicionar Cliente</h3>
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="telefone" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <input type="submit" name="add_cliente" value="Adicionar" class="btn btn-primary">
    </form>
</section>

<?php include 'rodape.html'; ?>
