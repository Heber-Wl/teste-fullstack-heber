<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php 
        echo $this->Html->css('alert');
        echo $this->Html->css('reset');

        // Fonte
        echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
    ?>
</head>
<body>
    <?= $this->Session->flash(); ?>
    <?= $this->Session->flash('success'); ?>
    <?= $this->Session->flash('error'); ?>

    <?= $this->fetch('content') ?>

    <?= $this->Html->script('https://code.jquery.com/jquery-3.6.0.min.js'); ?>
    <?= $this->Html->script('fecharClicarFora'); ?>
    <?= $this->Html->script('fecharSozinho'); ?>
</body>
</html>