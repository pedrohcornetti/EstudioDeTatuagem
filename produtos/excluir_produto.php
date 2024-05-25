<?php
require_once("../cabecalho.php");
?>
<h3>Excluir Produto</h3>
<form>
    <div class="row">
        <div class="col">
            <label for="nome" class="form-label">Informe o nome</label>
            <input type="text" class="form-control" name="nome" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="descricao" class="form-label">Informe a descição</label>
            <input type="text" class="form-control" name="descricao" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="valor" class="form-label">Informe o valor</label>
            <input type="text" class="form-control" name="valor" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="categoria" class="form-label">Selecione a categoria</label>
            <select class="form-select" name="categoria" disabled>
                <option value="1">Categoria 1</option>
                <option value="2">Categoria 2</option>
                <option value="3">Categoria 3</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="mt-3">Deseja realmente excluir?</p>
        <button type="submit" class="btn btn-danger">Excluir</button>
        </div>
    </div>
</form>
<?php
require_once("../rodape.html");