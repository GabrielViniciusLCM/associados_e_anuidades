<?php
$host = 'localhost';
$dbname = 'devs_do_rn';
$user = 'postgres';
$password = '123456';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_POST['id'];
    $valor = $_POST['valor'];

    // Atualiza o valor da anuidade
    $sql = "UPDATE anuidades SET valor = :valor WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['valor' => $valor, 'id' => $id]);

    echo "Anuidade atualizada com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao atualizar anuidade: " . $e->getMessage();
}
?>
