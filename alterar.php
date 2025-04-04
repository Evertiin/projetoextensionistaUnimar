<?php
require("conexao.php");

// Verifica se o ID foi passado via GET
if (!isset($_GET["id"])) {
    echo "ID da tarefa não informado.";
    exit;
}

$id = (int)$_GET["id"];


$sql = "SELECT * FROM tarefas WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Tarefa não encontrada.";
    exit;
}

$tarefa = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 380px;
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .container:hover {
            transform: scale(1.02);
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            color: #495057;
            align-self: flex-start;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 14px;
            transition: 0.3s;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
            outline: none;
        }

        .btn {
            background: linear-gradient(90deg, #28a745, #218838);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
            transition: background 0.3s ease-in-out;
        }

        .btn:hover {
            background: linear-gradient(90deg, #218838, #1e7e34);
        }

        .back-btn {
            background: linear-gradient(90deg, #6c757d, #495057);
            color: white;
            padding: 12px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            width: 100%;
            text-align: center;
            display: inline-block;
            margin-top: 10px;
        }

        .back-btn:hover {
            background: linear-gradient(90deg, #495057, #343a40);
        }
    </style>
</head>
<body>
    <h2>Editar Tarefa</h2>
    <div class="container">
        <form action="atualizar_tarefa.php" method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($tarefa['id']) ?>">

            <label for="titulo">Título da Tarefa:</label>
            <input type="text" id="titulo" name="titulo" required value="<?= htmlspecialchars($tarefa['titulo']) ?>">

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="4" required><?= htmlspecialchars($tarefa['descricao']) ?></textarea>

            <label for="data_vencimento">Data de Vencimento:</label>
            <input type="date" id="data_vencimento" name="data_vencimento" required value="<?= htmlspecialchars($tarefa['data_vencimento']) ?>">

            <label for="prioridade">Prioridade:</label>
            <select id="prioridade" name="prioridade" required>
                <option value="padrao" <?= $tarefa['prioridade'] == 'padrao' ? 'selected' : '' ?>>Padrão</option>
                <option value="media" <?= $tarefa['prioridade'] == 'media' ? 'selected' : '' ?>>Média</option>
                <option value="alta" <?= $tarefa['prioridade'] == 'alta' ? 'selected' : '' ?>>Alta</option>
                <option value="urgente" <?= $tarefa['prioridade'] == 'urgente' ? 'selected' : '' ?>>Urgente</option>
            </select>

            <button type="submit" class="btn">Salvar Alterações</button>
        </form>
        <a href="index.php" class="back-btn">Voltar</a>
    </div>
</body>
</html>
