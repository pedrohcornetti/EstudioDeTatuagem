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

// Busca as sessões para exibir na tabela
$sessoes = getSessoes($conn);
?>

<div class="container">
    <h2 class="my-4">Sessões</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente ID</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sessoes as $sessao) { ?>
            <tr>
                <td><?php echo $sessao['id']; ?></td>
                <td><?php echo $sessao['cliente_id']; ?></td>
                <td><?php echo $sessao['data']; ?></td>
                <td><?php echo $sessao['hora']; ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?php echo $sessao['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                    </form>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="edit_id" value="<?php echo $sessao['id']; ?>">
                        <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2 class="my-4">Adicionar Sessão</h2>
    <form method="post" class="form-inline">
        <div class="form-group">
            <label for="cliente_id">Cliente ID:</label>
            <input type="text" class="form-control mx-2" name="cliente_id" required>
        </div>
        <div class="form-group">
            <label for="data">Data:</label>
            <input type="date" class="form-control mx-2" name="data" required>
        </div>
        <div class="form-group">
            <label for="hora">Hora:</label>
            <input type="time" class="form-control mx-2" name="hora" required>
        </div>
        <input type="hidden" name="add_sessao" value="1">
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>

    <?php
    if (isset($_POST['edit_id'])) {
        $sessao = getSessao($conn, $_POST['edit_id']);
    ?>
    <h2 class="my-4">Editar Sessão</h2>
    <form method="post" class="form-inline">
        <input type="hidden" name="update_id" value="<?php echo $sessao['id']; ?>">
        <div class="form-group">
            <label for="cliente_id">Cliente ID:</label>
            <input type="text" class="form-control mx-2" name="cliente_id" value="<?php echo $sessao['cliente_id']; ?>" required>
        </div>
        <div class="form-group">
            <label for="data">Data:</label>
            <input type="date" class="form-control mx-2" name="data" value="<?php echo $sessao['data']; ?>" required>
        </div>
        <div class="form-group">
            <label for="hora">Hora:</label>
            <input type="time" class="form-control mx-2" name="hora" value="<?php echo $sessao['hora']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
    <?php } ?>
</div>

<?php include 'rodape.html'; ?>
