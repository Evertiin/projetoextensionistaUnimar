<?php
include 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Tarefas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            background-color: #007bff;
            color: white;
            padding: 20px;
            margin: 0;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .priority {
            font-weight: bold;
            color: #dc3545;
        }

        .button-container {
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            width: 80px;  /* Mantém o tamanho fixo */
            padding: 8px 0;
            text-align: center;
            font-size: 14px;
            border-radius: 5px;
            transition: background 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .edit-button {
            background-color: #ffc107;
            color: black;
            margin-right: 5px; /* Espaço entre os botões */
        }

        .edit-button:hover {
            background-color: #e0a800;
        }

        .delete-button {
            background-color: #dc3545;
            color: white;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .back-button {
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <h1>Lista de Tarefas</h1>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Prioridade</th>
                    <th>Vencimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM tarefas ORDER BY data_vencimento ASC";
                $result = $conn->query($sql);

                if (!$result) {
                    die("Erro na consulta SQL: " . $conn->error);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['titulo'] . "</td>";
                        echo "<td>" . $row['descricao'] . "</td>";
                        echo "<td class='priority'>" . ucfirst($row['prioridade']) . "</td>";
                        echo "<td>" . date('d/m/Y', strtotime($row['data_vencimento'])) . "</td>";
                        echo "<td class='actions'>
                                <a href='alterar.php?id=" . $row['id'] . "' class='button edit-button'>Editar</a>
                                <a href='excluir.php?id=" . $row['id'] . "' class='button delete-button' onclick='return confirm(\"Tem certeza que deseja excluir esta tarefa?\")'>Excluir</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhuma tarefa cadastrada.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>

        <div class="button-container">
            <button class="back-button" onclick="window.location.href='index.html'">Voltar</button>
        </div>
    </div>
</body>
</html>
