<div class="t"><?php echo $titulo; ?></div>		
<table border="0" cellspacing="3" cellpadding="0" class="tabla" width="100%">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Dirección</th>
    </tr>
    <?php foreach ($lista as $row): ?>
        <tr>
            <td><?php echo $row['usuid']; ?></td>
            <td><?php echo $row['usunombre']; ?></td>
            <td><?php echo $row['usudireccion']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>		   