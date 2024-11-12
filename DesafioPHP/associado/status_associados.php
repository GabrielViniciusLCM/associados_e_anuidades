<?php
$host = 'localhost';
$dbname = 'devs_do_rn';
$user = 'postgres';
$password = '123456';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para listar todos os associados
    $sql = "SELECT * FROM associados";
    $stmt = $pdo->query($sql);
    $associados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Status dos Associados</h2>";
    echo "<table border='1'><tr><th>Nome</th><th>E-mail</th><th>CPF</th><th>Status</th></tr>";

    foreach ($associados as $associado) {
        $associado_id = $associado['id'];
        $ano_filiacao = (int)date('Y', strtotime($associado['data_filiacao']));
        $ano_atual = (int)date('Y');

        // Verifica todas as anuidades desde o ano de filiação
        $sql = "SELECT a.id, a.ano, COALESCE(p.pago, 0) AS pago
                FROM anuidades a
                LEFT JOIN pagamentos p ON a.id = p.anuidade_id AND p.associado_id = :associado_id
                WHERE a.ano >= :ano_filiacao";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['associado_id' => $associado_id, 'ano_filiacao' => $ano_filiacao]);

        // Determina o status do associado
        $em_dia = true;
        while ($anuidade = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (!$anuidade['pago']) {
                $em_dia = false;
                break;
            }
        }

        echo "<tr>
                <td>{$associado['nome']}</td>
                <td>{$associado['email']}</td>
                <td>{$associado['cpf']}</td>
                <td>" . ($em_dia ? "Em Dia" : "Em Atraso") . "</td>
              </tr>";
    }
    echo "</table>";

} catch (PDOException $e) {
    echo "Erro ao buscar status dos associados: " . $e->getMessage();
}
?>
