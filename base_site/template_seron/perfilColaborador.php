<?php
include('session.php');
include_once('Classes/Colaborador.php');

// Instancia a classe Colaborador
$userColaborador = new Colaborador();

// Obtém o ID da sessão do usuário
$sessao_id = $_SESSION['id'];

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (isset($_POST['editar'])) {
        // Obter os dados do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];
        $confirmasenha = $_POST['confirmasenha'];

        // Chamar o método update para atualizar os dados do colaborador
        $userColaborador->update($sessao_id, $nome, $email, $cpf, $senha);
    } elseif (isset($_POST['excluir'])) {
        // Chamar o método para excluir a conta do colaborador
        $userColaborador->deleteColaborador($sessao_id);

        // Redirecionar para a página de index após excluir a conta
        header('Location: index.php');
        exit();
    }
}

// Obtém os dados do usuário
$dadosUsuario = $userColaborador->selectColaborador($sessao_id);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar e Excluir Colaborador</title>
</head>

<body>
    <h1>Editar e Excluir Colaborador</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>CPF</th>
                <th></th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dadosUsuario as $userColaborador) : ?>
                <tr>
                    <td><?php echo $userColaborador['id']; ?></td>
                    <td><?php echo $userColaborador['nome']; ?></td>
                    <td><?php echo $userColaborador['email']; ?></td>
                    <td><?php echo $userColaborador['cpf']; ?></td>
                    
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?php echo $userColaborador['id']; ?>">
                            <button type="submit" name="editar">Editar</button>
                            <button type="submit" name="excluir">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>
