<?php
$downloads = ["Visual Studio Code", "JetBrains IntelliJ", "Java JDK", "NetBeans 8"];
?>

<div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
    <?php foreach ($downloads as $name): ?>
        <div class="flex flex-col items-center justify-center rounded-md bg-accent p-6 text-center">
            <div class="mb-4 h-16 w-16 rounded-full bg-primary bg-opacity-20"></div>
            <h2 class="mb-4 text-lg font-semibold"><?php echo $name; ?></h2>
            <button class="rounded-md bg-secondary px-4 py-2 font-semibold text-primary hover:bg-opacity-80">
                DOWNLOAD
            </button>
        </div>
    <?php endforeach; ?>
</div>