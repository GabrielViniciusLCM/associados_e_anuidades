<?php
$host = 'localhost';
$dbname = 'devs_do_rn';
$user = 'postgres';
$password = '123456';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para obter a anuidade específica
        $sql = "SELECT * FROM anuidades WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $anuidade = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Erro ao obter anuidade: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Anuidade</title>
</head>
<body>
    <h1>Editar Anuidade para o Ano <?= htmlspecialchars($anuidade['ano']) ?></h1>
    <form action="processa_editar_anuidade.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($anuidade['id']) ?>">
        <label for="valor">Valor (R$):</label>
        <input type="number" step="0.01" id="valor" name="valor" value="<?= htmlspecialchars($anuidade['valor']) ?>" required><br><br>
        
        <input type="submit" value="Salvar Alterações">
    </form>
</body>
</html>
