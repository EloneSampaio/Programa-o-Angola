<h2>Prueba</h2>

<?php if(isset($this->categorias) && count($this->categorias)) : ?>

<table>
    
    <?php for($i = 0; $i < count($this->categorias); $i++): ?>
    
    <tr>
        <td><?php echo $this->categorias[$i]['id']; ?></td>
        <td><?php echo $this->categorias[$i]['nombre']; ?></td>
        
    </tr>
    
    <?php endfor;?>
</table>

<?php else: ?>

<p><strong>No hay posts!</strong></p>

<?php endif; ?>

<?php if(isset($this->paginacion)) echo $this->paginacion; ?>