<h1> Listado de Productos </h1>

<a href="/productos/crear"><button type="button" class="btn btn-success btn-lg">Crear</button></a>
<form>
<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Nombre del producto" aria-label="Recipient's username" aria-describedby="button-addon2" name="buscar">
  <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar</button>
</div>
</form>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Imagen</th>
      <th scope="col">Nombre</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Precio</th>
      <th scope="col">fecha de creacion</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($productos as $i => $producto) {?>
        <tr>
        <th scope="row"><?=$i + 1?></th>
        <td>
          <img src="<?=$producto['imagen']?>" class="imagen" >
        </td>
        <td><?=$producto['nombre']?></td>
        <td><?=$producto['descripcion']?></td>
        <td><?=$producto['precio']?></td>
        <td><?=$producto['fecha_creacion']?></td>
        <td>
          <a href="/productos/actualizar?id=<?php echo $producto['id'] ?>" class="btn btn-sm btn-outline-primary">actualizar</a>
          <form method="post" action="/productos/borrar" style="display: inline-block">
              <input  type="hidden" name="id" value="<?php echo $producto['id'] ?>"/>
              <button type="submit" class="btn btn-sm btn-outline-danger">borrar</button>
          </form>
        </td>
        </tr>
    <?php }?>
    </tbody>
</table>