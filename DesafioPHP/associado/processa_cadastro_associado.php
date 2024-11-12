<?php
// Configurações de conexão com o banco de dados
$host = 'localhost';
$dbname = 'devs_do_rn';
$user = 'postgres';
$password = '123456';

try {
    // Conexão com o PostgreSQL
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtém dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $data_filiacao = $_POST['data_filiacao'];

    // Insere o associado no banco de dados
    $sql = "INSERT INTO associados (nome, email, cpf, data_filiacao) VALUES (:nome, :email, :cpf, :data_filiacao)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nome' => $nome, 'email' => $email, 'cpf' => $cpf, 'data_filiacao' => $data_filiacao]);

    echo "Associado cadastrado com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao cadastrar associado: " . $e->getMessage();
}
?>
