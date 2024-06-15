<?php
// Configuração do banco de dados
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'estudio_tatuagem');

// Função para conectar ao banco de dados
function conectar() {
    try {
        $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Conexão falhou: " . $e->getMessage());
    }
}

// Funções para Gerenciamento de Clientes
function getClientes($conn) {
    $sql = "SELECT * FROM clientes";
    try {
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro na consulta SQL: " . $e->getMessage());
    }
}

function addCliente($conn, $nome, $telefone, $email) {
    $sql = "INSERT INTO clientes (nome, telefone, email) VALUES (?, ?, ?)";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nome, $telefone, $email]);
        return true;
    } catch (PDOException $e) {
        die("Erro ao adicionar cliente: " . $e->getMessage());
    }
}

function getCliente($conn, $id) {
    $sql = "SELECT * FROM clientes WHERE id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro na consulta SQL: " . $e->getMessage());
    }
}

function updateCliente($conn, $id, $nome, $telefone, $email) {
    $sql = "UPDATE clientes SET nome = ?, telefone = ?, email = ? WHERE id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nome, $telefone, $email, $id]);
        return true;
    } catch (PDOException $e) {
        die("Erro ao atualizar cliente: " . $e->getMessage());
    }
}

function deleteCliente($conn, $id) {
    // Excluir sessões associadas ao cliente
    $sql = "DELETE FROM sessoes WHERE cliente_id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        // Excluir cliente
        $sql = "DELETE FROM clientes WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        return true;
    } catch (PDOException $e) {
        die("Erro ao excluir cliente: " . $e->getMessage());
    }
}

// Funções para Gerenciamento de Artistas
function getArtistas($conn) {
    $sql = "SELECT * FROM artistas";
    try {
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro na consulta SQL: " . $e->getMessage());
    }
}

function addArtista($conn, $nome, $especialidade, $portfolio) {
    $sql = "INSERT INTO artistas (nome, especialidade, portfolio) VALUES (?, ?, ?)";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nome, $especialidade, $portfolio]);
        return true;
    } catch (PDOException $e) {
        die("Erro ao adicionar artista: " . $e->getMessage());
    }
}

function getArtista($conn, $id) {
    $sql = "SELECT * FROM artistas WHERE id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro na consulta SQL: " . $e->getMessage());
    }
}

function updateArtista($conn, $id, $nome, $especialidade, $portfolio) {
    $sql = "UPDATE artistas SET nome = ?, especialidade = ?, portfolio = ? WHERE id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nome, $especialidade, $portfolio, $id]);
        return true;
    } catch (PDOException $e) {
        die("Erro ao atualizar artista: " . $e->getMessage());
    }
}

function deleteArtista($conn, $id) {
    $sql = "DELETE FROM artistas WHERE id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return true;
    } catch (PDOException $e) {
        die("Erro ao excluir artista: " . $e->getMessage());
    }
}

// Funções para Gerenciamento de Sessões
function getSessoes($conn) {
    $sql = "SELECT * FROM sessoes";
    try {
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro na consulta SQL: " . $e->getMessage());
    }
}

function addSessao($conn, $cliente_id, $data, $hora) {
    $sql = "INSERT INTO sessoes (cliente_id, data, hora) VALUES (?, ?, ?)";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$cliente_id, $data, $hora]);
        return true;
    } catch (PDOException $e) {
        die("Erro ao adicionar sessão: " . $e->getMessage());
    }
}

function getSessao($conn, $id) {
    $sql = "SELECT * FROM sessoes WHERE id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro na consulta SQL: " . $e->getMessage());
    }
}

function updateSessao($conn, $id, $cliente_id, $data, $hora) {
    $sql = "UPDATE sessoes SET cliente_id = ?, data = ?, hora = ? WHERE id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$cliente_id, $data, $hora, $id]);
        return true;
    } catch (PDOException $e) {
        die("Erro ao atualizar sessão: " . $e->getMessage());
    }
}

function deleteSessao($conn, $id) {
    $sql = "DELETE FROM sessoes WHERE id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return true;
    } catch (PDOException $e) {
        die("Erro ao excluir sessão: " . $e->getMessage());
    }
}
?>
