<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cobrança de Anuidades</title>
</head>
<body>
    <h1>Cobrança de Anuidades</h1>

    <form method="POST">
        <label for="associado">Selecione o Associado:</label>
        <select id="associado" name="associado_id" required>
            <?php
            // Conectar ao banco de dados
            $host = 'localhost';
            $dbname = 'devs_do_rn';
            $user = 'postgres';
            $password = '123456';

            try {
                $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Consulta para buscar associados
                $sql = "SELECT id, nome FROM associados";
                $stmt = $pdo->query($sql);

                // Listar associados
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['nome']}</option>";
                }
            } catch (PDOException $e) {
                echo "Erro ao carregar associados: " . $e->getMessage();
            }
            ?>
        </select>
        <input type="submit" value="Ver Anuidades Devidas">
    </form>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['associado_id'])) {
            $associado_id = $_POST['associado_id'];
        
            try {
                // Busca data de filiação do associado
                $sql = "SELECT data_filiacao FROM associados WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['id' => $associado_id]);
                $associado = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if ($associado) {
                    $ano_filiacao = (int)date('Y', strtotime($associado['data_filiacao']));
                    $ano_atual = (int)date('Y');
        
                    // Busca anuidades desde o ano de filiação
                    $sql = "SELECT * FROM anuidades WHERE ano >= :ano_filiacao ORDER BY ano";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['ano_filiacao' => $ano_filiacao]);
        
                    $total_devido = 0;
                    echo "<h2>Anuidades devidas para o associado</h2>";
                    echo "<table border='1'><tr><th>Ano</th><th>Valor (R$)</th><th>Pago</th><th>Ação</th></tr>";
        
                    while ($anuidade = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        // Verifica se a anuidade foi paga
                        $sql = "SELECT pago FROM pagamentos WHERE associado_id = :associado_id AND anuidade_id = :anuidade_id";
                        $stmt2 = $pdo->prepare($sql);
                        $stmt2->execute(['associado_id' => $associado_id, 'anuidade_id' => $anuidade['id']]);
                        $pagamento = $stmt2->fetch(PDO::FETCH_ASSOC);
        
                        $pago = $pagamento && $pagamento['pago'] == 1;
        
                        // Exibe anuidade e botão de pagamento
                        echo "<tr>
                                <td>{$anuidade['ano']}</td>
                                <td>R$ " . number_format($anuidade['valor'], 2, ',', '.') . "</td>
                                <td>" . ($pago ? "Sim" : "Não") . "</td>";
        
                        if (!$pago) {
                            echo "<td>
                                    <form method='POST' action='marcar_pagamento.php'>
                                        <input type='hidden' name='associado_id' value='$associado_id'>
                                        <input type='hidden' name='anuidade_id' value='{$anuidade['id']}'>
                                        <input type='submit' value='Marcar como Paga'>
                                    </form>
                                  </td>";
                            $total_devido += $anuidade['valor'];
                        } else {
                            echo "<td>Pago</td>";
                        }
        
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<h3>Total Devido: R$ " . number_format($total_devido, 2, ',', '.') . "</h3>";
                } else {
                    echo "Associado não encontrado.";
                }
            } catch (PDOException $e) {
                echo "Erro ao buscar anuidades devidas: " . $e->getMessage();
            }
        }
    ?>
        

</body>
</html>
