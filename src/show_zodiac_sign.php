<?php include('header.php'); ?>

<?php
// Receber a data de nascimento do formulário
$data_nascimento = $_POST['data_nascimento'] ?? null;

// Carregar o XML
$signos = simplexml_load_file('signos.xml') or die("Erro ao carregar o arquivo XML.");

// Função para encontrar o signo
function encontrarSigno($data, $signos) {
    $dataNascimento = DateTime::createFromFormat('Y-m-d', $data);
    $diaMes = $dataNascimento->format('d/m');

    foreach ($signos->signo as $signo) {
        $inicio = DateTime::createFromFormat('d/m', (string)$signo->dataInicio);
        $fim = DateTime::createFromFormat('d/m', (string)$signo->dataFim);

        $inicio->setDate($dataNascimento->format('Y'), $inicio->format('m'), $inicio->format('d'));
        $fim->setDate($dataNascimento->format('Y'), $fim->format('m'), $fim->format('d'));


        // Verifica se a data está no intervalo do signo
        if ($inicio <= $dataNascimento && $dataNascimento <= $fim) {
            return $signo;
        }

        // Caso o signo cruze o ano
        if ($inicio > $fim && ($dataNascimento >= $inicio || $dataNascimento <= $fim)) {
            return $signo;
        }
    }
    return null;
}

// Processar a data
$resultado = null;
if ($data_nascimento) {
    $resultado = encontrarSigno($data_nascimento, $signos);
}
?>

<div class="container mt-5">
    <?php if ($resultado): ?>
        <div class="alert alert-success">
            <h2>Seu Signo: <?= htmlspecialchars($resultado->signoNome) ?></h2>
            <p><strong>Período:</strong> <?= htmlspecialchars($resultado->dataInicio) ?> a <?= htmlspecialchars($resultado->dataFim) ?></p>
            <p><strong>Descrição:</strong> <?= htmlspecialchars($resultado->descricao) ?></p>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">
            <p>Não foi possível encontrar o signo para a data informada. Verifique se o formato está correto.</p>
        </div>
    <?php endif; ?>
    <a href="index.php" class="btn btn-primary mt-3">Voltar</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
