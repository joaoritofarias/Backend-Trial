<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Backend Trial</title>
        <style>
            table, tr, td, th { border: 1px solid #000; }
        </style>
    </head>
    <body>
        <h1>Lista de Produtos</h1>

        <table>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Stock</th>
            </tr>
<?php
    foreach($products as $product) {
?>
        <tr>
            <td><?php echo $product["name"]; ?></td>
            <td><?php echo $product["description"]; ?></td>
            <td><?php echo $product["price"]; ?>€</td>
            <td><?php echo $product["stock"]; ?> [Unidades]</td>
            <td>
                <form method="post">
                    <input type="hidden" name="product" value="<?php echo $product["product_id"]; ?>">
                    <button type="button" name="edit" value="submit">Editar</button>
                </form>
            </td>
        </tr>
<?php
    }
?>
        </table>

        <h2>Adicionar um producto:</h2>

        <form method="post">
            <div>
                <label>
                    Nome do Producto
                    <input type="text" name="name" required minlength="2" maxlength="64" required value="<?php echo $name; ?>">
                </label>
            </div>
            <div>
                <textarea name="description" cols="30" rows="10" required value="<?php echo $description; ?>">Descreva aqui o produto...</textarea>
            </div>
            <div>
                <label>
                    Preço
                    <input type="number" name="price" maxlength="4" required value="<?php echo $price; ?>">
                </label>
            </div>

            <div>
                <label>
                    Stock
                    <input type="number" name="stock" maxlength="4" required value="<?php echo $stock; ?>">
                </label>
            </div>
        <div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" name="send" value="submit">Criar o Produto</button>
        </div>

        </form>

    </body>
</html>

