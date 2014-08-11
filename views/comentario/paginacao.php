<h2>Prueba</h2>

<?php if(isset($this->comentarios) && count($this->comentarios)) : ?>

<table>
    
    <?php for($i = 0; $i < count($this->comentarios); $i++): ?>
    
    <tr>
        <td><?php echo $this->comentarios[$i]['id']; ?></td>
        <td><?php echo $this->comentarios[$i]['nombre']; ?></td>
        
    </tr>
    
    <?php endfor;?>
</table>

<?php else: ?>

<p><strong>No hay posts!</strong></p>

<?php endif; ?>

<?php if(isset($this->paginacion)) echo $this->paginacion; ?>