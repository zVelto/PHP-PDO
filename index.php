<?php

if(!empty($_POST['usuario']) && !empty($_POST['senha'])) {

    $dsn = 'mysql:host=localhost;dbname=php_com_pdo';
    $usuario = 'root';
    $senha = '';

    try {
        $conexao = new PDO($dsn, $usuario, $senha);
        // $query = "insert into tb_usuarios(nome, email, senha)values('Jorge Sant Ana', 'jorge@teste.com.br', '1234')";
        //$conexao->query($query);
        // $query = "insert into tb_usuarios(nome, email, senha)values('Jamilton Damasceno', 'jamilton@teste.com.br', '1234')";
        //$conexao->query($query);
        // $query = "insert into tb_usuarios(nome, email, senha)values('Fernanda Silva', 'fernanda@teste.com.br', '1234')";
        //$conexao->query($query);

        $query = "select * from tb_usuarios where ";
        $query .= " email = :usuario ";
        $query .= " AND senha = :senha ";

        $stmt = $conexao->prepare($query); //ele não executa diretamente a query, ele aguarda seu ok para executar
        
        $stmt->bindValue(':usuario', $_POST['usuario']);
        $stmt->bindValue(':senha', $_POST['senha']);

        $stmt->execute(); //executa a query depois do bindValue

        $usuario = $stmt->fetch();

        print_r($usuario);

    } catch (PDOException $e) {
        echo 'Erro: ' . $e->getCode() . ' Mensagem: ' . $e->getMessage();
        //registrar o erro de alguma forma.
    }

}
?>

<html>
    <meta charset="utf-8">
    <title>Login</title>
</html>



<body>
    <form method="post" action="index.php">
        <input type="text" placeholder="usuário" name="usuario"/>
        <br/>
        <input type="password" placeholder="senha" name="senha"/>
        <br/>
        <button type="submit">Entrar</button>
    </form>
</body>
