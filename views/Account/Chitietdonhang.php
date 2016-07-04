<?php foreach($ctpdh as $c) { ?>
<tr>
    <td><?php echo $c->getSanpham()->getTensanpham(); ?></td>
    <td><?php echo $c->getSoluong(); ?></td>
    <td><?php echo $c->getSanpham()->getGiasp(); ?></td>
    <td><?php echo $c->getSanpham()->getGiasp()*$c->getSoluong(); ?>.000</td>
</tr>
<?php } ?>
