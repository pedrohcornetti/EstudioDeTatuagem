<?php
include 'navbar.php';
require 'funcao.php';
$conn = conectar();

// Processa a exclusão de artistas
if (isset($_POST['delete_id'])) {
    deleteArtista($conn, $_POST['delete_id']);
}

// Processa a atualização de artistas
if (isset($_POST['update_id'])) {
    updateArtista($conn, $_POST['update_id'], $_POST['nome'], $_POST['especialidade'], $_POST['portfolio']);
}

// Processa a adição de artistas
if (isset($_POST['add_artista'])) {
    addArtista($conn, $_POST['nome'], $_POST['especialidade'], $_POST['portfolio']);
}

// Busca os artistas para exibir na tabela
$artistas = getArtistas($conn);
?>

<div class="container">
    <h2 class="my-4">Artistas</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Especialidade</th>
                <th>Portfolio</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($artistas as $artista) { ?>
            <tr>
                <td><?php echo $artista['id']; ?></td>
                <td><?php echo $artista['nome']; ?></td>
                <td><?php echo $artista['especialidade']; ?></td>
                <td><?php echo $artista['portfolio']; ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?php echo $artista['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                    </form>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="edit_id" value="<?php echo $artista['id']; ?>">
                        <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2 class="my-4">Adicionar Artista</h2>
    <form method="post" class="form-inline">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control mx-2" name="nome" required>
        </div>
        <div class="form-group">
            <label for="especialidade">Especialidade:</label>
            <input type="text" class="form-control mx-2" name="especialidade" required>
        </div>
        <div class="form-group">
            <label for="portfolio">Portfolio:</label>
            <input type="text" class="form-control mx-2" name="portfolio" required>
        </div>
        <input type="hidden" name="add_artista" value="1">
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>

    <?php
    if (isset($_POST['edit_id'])) {
        $artista = getArtista($conn, $_POST['edit_id']);
    ?>
    <h2 class="my-4">Editar Artista</h2>
    <form method="post" class="form-inline">
        <input type="hidden" name="update_id" value="<?php echo $artista['id']; ?>">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control mx-2" name="nome" value="<?php echo $artista['nome']; ?>" required>
        </div>
        <div class="form-group">
            <label for="especialidade">Especialidade:</label>
            <input type="text" class="form-control mx-2" name="especialidade" value="<?php echo $artista['especialidade']; ?>" required>
        </div>
        <div class="form-group">
            <label for="portfolio">Portfolio:</label>
            <input type="text" class="form-control mx-2" name="portfolio" value="<?php echo $artista['portfolio']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
    <?php } ?>
</div>

<?php include 'rodape.html'; ?>
