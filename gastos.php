<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}
include('db.php');
$email = $_SESSION['email'];
$query = "SELECT * FROM transacao WHERE tipo='Débito'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Gastos</h1>
        <div class="chart">Gráfico de Gastos</div>
        <table>
            <tr>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Categoria</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['descricao']; ?></td>
                    <td><?php echo $row['valor']; ?></td>
                    <td><?php echo $row['data']; ?></td>
                    <td><?php echo $row['categoria_nome']; ?></td>
                </tr>
            <?php } ?>
        </table>
        <a href="add_gasto.php" class="add-button">Adicionar Gasto</a>
    </div>
</body>
</html>