<?php
require_once 'verifica_admin.php';
require_once '../services/conexao.php';

// formulário para editar usuários
if (!isset($_GET['id'])) {
    header("Location: usuarios.php");
    exit();
}
$id = $_GET['id'];

$check_sql = "SELECT is_admin FROM usuarios WHERE id = ?";
$check_stmt = $conexao->prepare($check_sql);
$check_stmt->bind_param("i", $id);
$check_stmt->execute();
$check_result = $check_stmt->get_result()->fetch_assoc();


if ($check_result && $check_result['is_admin'] == 0) {
    die("Erro: Não é permitido editar usuários do tipo Cliente.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;
    
    if ($id == $_SESSION['admin_id'] && $is_admin == 0) {
        $erro = "Você não pode remover a permissão de administrador de sua própria conta.";
    } else {
        $sql = "UPDATE usuarios SET nome = ?, email = ?, is_admin = ?";
        $types = "ssi";
        $params = [$nome, $email, $is_admin];

        if (!empty($_POST['senha'])) {
            $senha_hashed = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $sql .= ", senha = ?";
            $types .= "s";
            $params[] = $senha_hashed;
        }

        $sql .= " WHERE id = ?";
        $types .= "i";
        $params[] = $id;

        $stmt = $conexao->prepare($sql);
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            header("Location: usuarios.php?status=editado_sucesso");
            exit();
        } else {
            $erro = "Erro ao editar o usuário: " . $stmt->error;
        }
    }
}

$sql_select = "SELECT id, nome, email, is_admin FROM usuarios WHERE id = ?";
$stmt_select = $conexao->prepare($sql_select);
$stmt_select->bind_param("i", $id);
$stmt_select->execute();
$resultado = $stmt_select->get_result();
$usuario = $resultado->fetch_assoc();

require_once 'includes/header.php';
?>

<h2 class="my-4">Editar Usuário Administrador</h2>
<?php if (isset($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST">
            <div class="mb-3"><label for="nome" class="form-label">Nome Completo</label><input type="text" name="nome" id="nome" class="form-control" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required></div>
            <div class="mb-3"><label for="email" class="form-label">Email</label><input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($usuario['email']); ?>" required></div>
            <div class="mb-3"><label for="senha" class="form-label">Nova Senha</label><input type="password" name="senha" id="senha" class="form-control" placeholder="Deixe em branco para não alterar"><div class="form-text">Preencha este campo apenas se desejar alterar a senha do usuário.</div></div>
            <div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="is_admin" value="1" id="is_admin_check" <?php if ($usuario['is_admin'] == 1) echo 'checked'; ?>><label class="form-check-label" for="is_admin_check">Este usuário é um Administrador</label></div>
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="usuarios.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>