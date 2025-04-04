<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Tarefa</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
        include 'conexao.php';

        
        $id = (int)$_GET['id'];

        
        $sql = "SELECT * FROM tarefas WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "<p>Tarefa não encontrada.</p>";
            exit;
        }
    ?>
   
    <form action="alterar.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" value="<?php echo $row['titulo']; ?>" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" required><?php echo $row['descricao']; ?></textarea><br><br>

        <label for="prioridade">Prioridade:</label><br>
        <select id="prioridade" name="prioridade" required>
            <option value="Baixa" <?php if ($row['prioridade'] == 'Baixa') echo 'selected'; ?>>Baixa</option>
            <option value="Média" <?php if ($row['prioridade'] == 'Média') echo 'selected'; ?>>Média</option>
            <option value="Alta" <?php if ($row['prioridade'] == 'Alta') echo 'selected'; ?>>Alta</option>
        </select><br><br>

        <label for="data_vencimento">Data de Vencimento:</label><br>
        <input type="date" id="data_vencimento" name="data_vencimento" value="<?php echo $row['data_vencimento']; ?>" required><br><br>

        <input type="submit" value="Alterar">
    </form>
</body>
</html>
