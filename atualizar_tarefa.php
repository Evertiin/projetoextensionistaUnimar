<?php
require("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $prioridade = $_POST['prioridade'];
    $data_vencimento = $_POST['data_vencimento'];

    if ($id > 0 && !empty($titulo) && !empty($descricao) && !empty($data_vencimento) && !empty($data_vencimento)) {
        $sql = "UPDATE tarefas 
                SET titulo = '$titulo', 
                    descricao = '$descricao', 
                    data_vencimento = '$data_vencimento', 
                    prioridade = '$prioridade' 
                WHERE id = $id";

        echo "<style>
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
                    text-align: center;
                    width: 400px;
                }
                .success {
                    color: green;
                    font-weight: bold;
                    font-size: 18px;
                    margin-bottom: 15px;
                }
                .error {
                    color: red;
                    font-weight: bold;
                    font-size: 18px;
                    margin-bottom: 15px;
                }
                .btn {
                    display: inline-block;
                    padding: 10px 15px;
                    background: linear-gradient(90deg, #007BFF, #0056b3);
                    color: white;
                    border: none;
                    border-radius: 5px;
                    font-size: 14px;
                    text-decoration: none;
                    font-weight: bold;
                    transition: 0.3s;
                }
                .btn:hover {
                    background: linear-gradient(90deg, #0056b3, #003f7f);
                }
              </style>";

        echo "<div class='container'>";
        if ($conn->query($sql) === TRUE) {
            echo "<p class='success'>✅ Tarefa atualizada com sucesso!</p>";
        } else {
            echo "<p class='error'>❌ Erro ao atualizar tarefa: " . $conn->error . "</p>";
        }
        echo "<a href='visualizar.php' class='btn'>Voltar para a Lista de Tarefas</a>";
        echo "</div>";
        
    }

    $conn->close();
}
?>
