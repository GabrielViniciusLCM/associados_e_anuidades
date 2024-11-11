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
    $ano = $_POST['ano'];
    $valor = $_POST['valor'];

    // Insere a anuidade no banco de dados
    $sql = "INSERT INTO anuidades (ano, valor) VALUES (:ano, :valor)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['ano' => $ano, 'valor' => $valor]);

    echo "Anuidade cadastrada com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao cadastrar anuidade: " . $e->getMessage();
}
?>
