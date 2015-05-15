<div class="t"><?php echo $titulo; ?></div>		
<table border="0" cellspacing="3" cellpadding="0" class="tabla" width="100%">
    <tr>
        
        <th>Nombre</th>
        <th>Email</th>
        <th>clave</th>
        <th>Edad</th>
        <th>ID</th>
    </tr>
    <?php foreach ($lista as $row): ?>
        <tr>
            
            <td><?php echo $row['NOMBRE']; ?></td>
            <td><?php echo $row['EMAIL']; ?></td>
            <td><?php echo $row['CLAVE']; ?></td>
            <td><?php echo $row['EDAD']; ?></td>
            <td><?php echo $row['ID']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>		   