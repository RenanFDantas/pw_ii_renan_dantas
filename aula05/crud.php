<?php 
// Conectar ao banco de dados
$db = new mysqli('localhost', 'root', '', 'crud');

//Funções para CRUD
function getNomes() {
    global $db;
    $sql = "SELECT * FROM nomes";
    $result = $db->query($sql);
    $nomes[];
    while ($row = $result->fetch_assoc()) {
        $nomes[] = $row;
    }
    return $nomes;
}

function editarNome($id, $nome) {
    global $db;
    $sql = "INSERT INTO nomes (nome) VALUES ('$nome')";
    $db->query($sql);
}

function editarNome($id, $nome) {
    global $db;
    $sql = "UPDATE nomes SET nome = '$nome' WHERE id = $id";
    $db->query($sql);
}

function excluirNome($id) {
    global $db;
    $sql = "DELETE FROM nomes WHERE id = $id";
    $db->query($sql);
}

//Ações do CRUD
$acao = isset($_GET['acao']) ? $_GET['acao'] : null;
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';

if ($acao === 'adicionar') {
    adicionarNome($nome);
    header('Location: crud.php');
    exit();
}elseif ($acao === 'editar') {
    $id = intval($_GET['id']);
    $nomeoriginal = ($_GET['nome']);
    $nome = $_POST['nome'];
    editarNome($id, $nome);
    header('LOcation: editar.php?id=' . $id . 'nome=' . $nomeoriginal);
    exit();
}elseif ($acao === 'excluir') {
    excluirNome($id);
    header('Location: crud.php');
    exit();
}

//Obter todos os nomes
$nomes = getNomes();
?>

<h1>Lista de Nomes</h1>
<form method="post" action="?acao=adicionar">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required="required">
    <button type="submit">Adicionar</button>
</form>
<table border="border">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($nomes as $nome) : ?>