<?php
$host = 'localhost';
$dbname = 'devs_do_rn';
$user = 'postgres';
$password = '123456';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['associado_id'], $_POST['anuidade_id'])) {
        $associado_id = $_POST['associado_id'];
        $anuidade_id = $_POST['anuidade_id'];

        // Marca o pagamento da anuidade como pago
        $sql = "INSERT INTO pagamentos (associado_id, anuidade_id, pago) 
                VALUES (:associado_id, :anuidade_id, 1)
                ON CONFLICT (associado_id, anuidade_id) DO UPDATE SET pago = 1";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['associado_id' => $associado_id, 'anuidade_id' => $anuidade_id]);

        echo "Pagamento registrado com sucesso!";
        header("Location: cobranca_anuidades.php"); // Redireciona para a página de cobrança
        exit;
    } else {
        echo "Dados inválidos para processar o pagamento.";
    }
} catch (PDOException $e) {
    echo "Erro ao processar pagamento: " . $e->getMessage();
}
?>
