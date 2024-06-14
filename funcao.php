<?php
// Configuração do banco de dados
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'estudio_tatuagem');

// Função para conectar ao banco de dados
function conectar() {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
    
    return $conn;
}

// Funções para gerenciamento de clientes
function getClientes($conn) {
    $sql = "SELECT * FROM clientes";
    $result = $conn->query($sql);
    if ($result === false) {
        die("Erro na consulta SQL: " . $conn->error);
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}

function addCliente($conn, $nome, $telefone, $email) {
    $sql = "INSERT INTO clientes (nome, telefone, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $telefone, $email);
    return $stmt->execute();
}

function getCliente($conn, $id) {
    $sql = "SELECT * FROM clientes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function updateCliente($conn, $id, $nome, $telefone, $email) {
    $sql = "UPDATE clientes SET nome = ?, telefone = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nome, $telefone, $email, $id);
    return $stmt->execute();
}

function deleteCliente($conn, $id) {
    $sql = "DELETE FROM clientes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Funções para gerenciamento de artistas
function getArtistas($conn) {
    $sql = "SELECT * FROM artistas";
    $result = $conn->query($sql);
    if ($result === false) {
        die("Erro na consulta SQL: " . $conn->error);
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}

function addArtista($conn, $nome, $especialidade, $portfolio) {
    $sql = "INSERT INTO artistas (nome, especialidade, portfolio) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $especialidade, $portfolio);
    return $stmt->execute();
}

function getArtista($conn, $id) {
    $sql = "SELECT * FROM artistas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function updateArtista($conn, $id, $nome, $especialidade, $portfolio) {
    $sql = "UPDATE artistas SET nome = ?, especialidade = ?, portfolio = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nome, $especialidade, $portfolio, $id);
    return $stmt->execute();
}

function deleteArtista($conn, $id) {
    $sql = "DELETE FROM artistas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Funções para gerenciamento de sessões
function getSessoes($conn) {
    $sql = "SELECT * FROM sessoes";
    $result = $conn->query($sql);
    if ($result === false) {
        die("Erro na consulta SQL: " . $conn->error);
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}

function addSessao($conn, $cliente_id, $data, $hora) {
    $sql = "INSERT INTO sessoes (cliente_id, data, hora) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $cliente_id, $data, $hora);
    return $stmt->execute();
}

function getSessao($conn, $id) {
    $sql = "SELECT * FROM sessoes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function updateSessao($conn, $id, $cliente_id, $data, $hora) {
    $sql = "UPDATE sessoes SET cliente_id = ?, data = ?, hora = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issi", $cliente_id, $data, $hora, $id);
    return $stmt->execute();
}

function deleteSessao($conn, $id) {
    $sql = "DELETE FROM sessoes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Funções para gerenciamento de desenhos
function getDesenhos($conn) {
    $sql = "SELECT * FROM desenhos";
    $result = $conn->query($sql);
    if ($result === false) {
        die("Erro na consulta SQL: " . $conn->error);
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}

function addDesenho($conn, $sessao_id, $nome, $descricao) {
    $sql = "INSERT INTO desenhos (sessao_id, nome, descricao) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $sessao_id, $nome, $descricao);
    return $stmt->execute();
}

function getDesenho($conn, $id) {
    $sql = "SELECT * FROM desenhos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function updateDesenho($conn, $id, $sessao_id, $nome, $descricao) {
    $sql = "UPDATE desenhos SET sessao_id = ?, nome = ?, descricao = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issi", $sessao_id, $nome, $descricao, $id);
    return $stmt->execute();
}

function deleteDesenho($conn, $id) {
    $sql = "DELETE FROM desenhos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>
