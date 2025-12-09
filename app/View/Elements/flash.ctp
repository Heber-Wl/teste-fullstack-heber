<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php 
        echo $this->Html->css('alert');
        echo $this->Html->css('reset');
    ?>
</head>
<body>
    <?php foreach ($this->Session->read('Message') as $key => $message): ?>
        <div class="alert 
            <?php if ($message['element'] === 'default'): ?>
                alert-info
            <?php elseif ($message['element'] === 'success'): ?>
                alert-success
            <?php elseif ($message['element'] === 'error'): ?>
                alert-danger
            <?php else: ?>
                alert-info
            <?php endif; ?>
        ">
            <?= h($message['message']); ?>
        </div>
    <?php endforeach; ?>
    
    <?php $this->Session->delete('Message'); ?>
    <?php 
        echo $this->Html->script('https://code.jquery.com/jquery-3.6.0.min.js');
        echo $this->Html->script('fecharClicarFora');
        echo $this->Html->script('fecharSozinho');
    ?>
</body>
</html>

