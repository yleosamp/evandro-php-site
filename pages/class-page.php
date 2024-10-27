<?php
$year = isset($_GET['year']) ? $_GET['year'] : '';
$class = isset($_GET['class']) ? $_GET['class'] : '';

$yearName = $year === "segundo" ? "2º ANO" : "TERCEIRÃO";
?>

<div class="text-center">
    <h2 class="text-2xl font-bold mb-4"><?php echo "{$yearName} - {$class} Arquivos"; ?></h2>
    <p class="text-lg"><?php echo "Recursos do {$yearName} - {$class}."; ?></p>
</div>