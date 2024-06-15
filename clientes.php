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

// Busca os clientes para exibir na tabela
$clientes = getClientes($conn);
?>

<div class="container">
    <h2 class="my-4">Clientes</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente) { ?>
            <tr>
                <td><?php echo $cliente['id']; ?></td>
                <td><?php echo $cliente['nome']; ?></td>
                <td><?php echo $cliente['telefone']; ?></td>
                <td><?php echo $cliente['email']; ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?php echo $cliente['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                    </form>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="edit_id" value="<?php echo $cliente['id']; ?>">
                        <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2 class="my-4">Adicionar Cliente</h2>
    <form method="post" class="form-inline">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control mx-2" name="nome" required>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="text" class="form-control mx-2" name="telefone" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control mx-2" name="email" required>
        </div>
        <input type="hidden" name="add_cliente" value="1">
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>

    <?php
    if (isset($_POST['edit_id'])) {
        $cliente = getCliente($conn, $_POST['edit_id']);
    ?>
    <h2 class="my-4">Editar Cliente</h2>
    <form method="post" class="form-inline">
        <input type="hidden" name="update_id" value="<?php echo $cliente['id']; ?>">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control mx-2" name="nome" value="<?php echo $cliente['nome']; ?>" required>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="text" class="form-control mx-2" name="telefone" value="<?php echo $cliente['telefone']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control mx-2" name="email" value="<?php echo $cliente['email']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
    <?php } ?>
</div>

<?php include 'rodape.html'; ?>
