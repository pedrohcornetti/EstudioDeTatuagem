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
?>

<section>
    <h2>Artistas</h2>
    <ul class="list-group">
        <?php
        $artistas = getArtistas($conn);
        if ($artistas !== null) {
            foreach ($artistas as $artista): ?>
                <li class="list-group-item">
                    <?php echo $artista['nome']; ?> - <?php echo $artista['especialidade']; ?> - <?php echo $artista['portfolio']; ?>
                    <form method="post" class="float-right">
                        <input type="hidden" name="delete_id" value="<?php echo $artista['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                    <button class="btn btn-secondary btn-sm float-right mr-2" data-toggle="modal" data-target="#updateModal<?php echo $artista['id']; ?>">Editar</button>

                    <!-- Modal de Edição -->
                    <div class="modal fade" id="updateModal<?php echo $artista['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel<?php echo $artista['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel<?php echo $artista['id']; ?>">Editar Artista</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post">
                                    <div class="modal-body">
                                        <input type="hidden" name="update_id" value="<?php echo $artista['id']; ?>">
                                        <div class="form-group">
                                            <label>Nome:</label>
                                            <input type="text" name="nome" class="form-control" value="<?php echo $artista['nome']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Especialidade:</label>
                                            <input type="text" name="especialidade" class="form-control" value="<?php echo $artista['especialidade']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Portfolio:</label>
                                            <textarea name="portfolio" class="form-control" required><?php echo $artista['portfolio']; ?></textarea>
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
            echo "<li class='list-group-item'>Nenhum artista encontrado.</li>";
        }
        ?>
    </ul>

    <form method="post" class="mt-3">
        <h3>Adicionar Artista</h3>
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Especialidade:</label>
            <input type="text" name="especialidade" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Portfolio:</label>
            <textarea name="portfolio" class="form-control" required></textarea>
        </div>
        <input type="submit" name="add_artista" value="Adicionar" class="btn btn-primary">
    </form>
</section>

<?php include 'rodape.html'; ?>
