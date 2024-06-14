<?php
include 'navbar.php';
require 'funcao.php';
$conn = conectar();

// Processa a exclusão de sessões
if (isset($_POST['delete_id'])) {
    deleteSessao($conn, $_POST['delete_id']);
}

// Processa a atualização de sessões
if (isset($_POST['update_id'])) {
    updateSessao($conn, $_POST['update_id'], $_POST['cliente_id'], $_POST['data'], $_POST['hora']);
}

// Processa a adição de sessões
if (isset($_POST['add_sessao'])) {
    addSessao($conn, $_POST['cliente_id'], $_POST['data'], $_POST['hora']);
}
?>

<section>
    <h2>Sessões</h2>
    <ul class="list-group">
        <?php
        $sessoes = getSessoes($conn);
        if ($sessoes !== null) {
            foreach ($sessoes as $sessao): ?>
                <li class="list-group-item">
                    Cliente ID: <?php echo $sessao['cliente_id']; ?> - Data: <?php echo $sessao['data']; ?> - Hora: <?php echo $sessao['hora']; ?>
                    <form method="post" class="float-right">
                        <input type="hidden" name="delete_id" value="<?php echo $sessao['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                    <button class="btn btn-secondary btn-sm float-right mr-2" data-toggle="modal" data-target="#updateModal<?php echo $sessao['id']; ?>">Editar</button>

                    <!-- Modal de Edição -->
                    <div class="modal fade" id="updateModal<?php echo $sessao['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel<?php echo $sessao['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel<?php echo $sessao['id']; ?>">Editar Sessão</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post">
                                    <div class="modal-body">
                                        <input type="hidden" name="update_id" value="<?php echo $sessao['id']; ?>">
                                        <div class="form-group">
                                            <label>Cliente ID:</label>
                                            <input type="number" name="cliente_id" class="form-control" value="<?php echo $sessao['cliente_id']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Data:</label>
                                            <input type="date" name="data" class="form-control" value="<?php echo $sessao['data']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Hora:</label>
                                            <input type="time" name="hora" class="form-control" value="<?php echo $sessao['hora']; ?>" required>
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
            echo "<li class='list-group-item'>Nenhuma sessão encontrada.</li>";
        }
        ?>
    </ul>

    <form method="post" class="mt-3">
        <h3>Adicionar Sessão</h3>
        <div class="form-group">
            <label>Cliente ID:</label>
            <input type="number" name="cliente_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Data:</label>
            <input type="date" name="data" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Hora:</label>
            <input type="time" name="hora" class="form-control" required>
        </div>
        <input type="submit" name="add_sessao" value="Adicionar" class="btn btn-primary">
    </form>
</section>

<?php include 'rodape.html'; ?>
