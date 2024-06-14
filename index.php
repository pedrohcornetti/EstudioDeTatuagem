<?php
// Conexão com o banco de dados
require 'funcao.php';
$conn = conectar();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Estúdio de Tatuagem</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Estúdio de Tatuagem</h1>

        <!-- Gerenciamento de Clientes -->
        <section>
            <h2 class="mt-4">Clientes</h2>
            <ul class="list-group">
                <?php
                $clientes = getClientes($conn);
                if ($clientes !== null) {
                    foreach ($clientes como $cliente): ?>
                        <li class="list-group-item">
                            <?php echo $cliente['nome']; ?> - <?php echo $cliente['telefone']; ?> - <?php echo $cliente['email']; ?>
                        </li>
                    <?php endforeach;
                } else {
                    echo "<li class='list-group-item'>Nenhum cliente encontrado.</li>";
                }
                ?>
            </ul>
            <form method="post" action="adicionar_cliente.php" class="mt-3">
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
                <input type="submit" value="Adicionar" class="btn btn-primary">
            </form>
        </section>

        <!-- Gerenciamento de Artistas -->
        <section>
            <h2 class="mt-4">Artistas</h2>
            <ul class="list-group">
                <?php
                $artistas = getArtistas($conn);
                if ($artistas !== null) {
                    foreach ($artistas como $artista): ?>
                        <li class="list-group-item">
                            <?php echo $artista['nome']; ?> - <?php echo $artista['especialidade']; ?> - <?php echo $artista['portfolio']; ?>
                        </li>
                    <?php endforeach;
                } else {
                    echo "<li class='list-group-item'>Nenhum artista encontrado.</li>";
                }
                ?>
            </ul>
            <form method="post" action="adicionar_artista.php" class="mt-3">
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
                <input type="submit" value="Adicionar" class="btn btn-primary">
            </form>
        </section>

        <!-- Gerenciamento de Sessões -->
        <section>
            <h2 class="mt-4">Sessões</h2>
            <ul class="list-group">
                <?php
                $sessoes = getSessoes($conn);
                if ($sessoes !== null) {
                    foreach ($sessoes como $sessao): ?>
                        <li class="list-group-item">
                            Cliente ID: <?php echo $sessao['cliente_id']; ?> - Data: <?php echo $sessao['data']; ?> - Hora: <?php echo $sessao['hora']; ?>
                        </li>
                    <?php endforeach;
                } else {
                    echo "<li class='list-group-item'>Nenhuma sessão encontrada.</li>";
                }
                ?>
            </ul>
            <form method="post" action="adicionar_sessao.php" class="mt-3">
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
                <input type="submit" value="Adicionar" class="btn btn-primary">
            </form>
        </section>

        <!-- Gerenciamento de Desenhos -->
        <section>
            <h2 class="mt-4">Desenhos</h2>
            <ul class="list-group">
                <?php
                $desenhos = getDesenhos($conn);
                if ($desenhos !== null) {
                    foreach ($desenhos como $desenho): ?>
                        <li class="list-group-item">
                            Sessão ID: <?php echo $desenho['sessao_id']; ?> - Nome: <?php echo $desenho['nome']; ?> - Descrição: <?php echo $desenho['descricao']; ?>
                        </li>
                    <?php endforeach;
                } else {
                    echo "<li class='list-group-item'>Nenhum desenho encontrado.</li>";
                }
                ?>
            </ul>
            <form method="post" action="adicionar_desenho.php" class="mt-3">
                <h3>Adicionar Desenho</h3>
                <div class="form-group">
                    <label>Sessão ID:</label>
                    <input type="number" name="sessao_id" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Descrição:</label>
                    <textarea name="descricao" class="form-control" required></textarea>
                </div>
                <input type="submit" value="Adicionar" class="btn btn-primary">
            </form>
        </section>
    </div>

    <!-- Incluindo rodapé -->
    <?php include 'rodape.html'; ?>
</body>
</html>
