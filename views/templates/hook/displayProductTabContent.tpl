<h3 class="page-product-heading">Fotos de clientes</h3>
{if isset($saveForm)}
    <div class="alert alert-success">Imagen añadida</div>
{/if}
{if isset($errorForm)}
    <div class="alert alert-danger">{$errorForm}</div>
{/if}
<div class="fotocliente_bloque">
    <form action="" enctype="multipart/form-data" method="post" id="comment_form">
        <div class="form-group col-xs-12 col-md-4">
            <label for="foto">Foto:</label>
            <input type="file" name="foto" id="foto">
        </div>
        <div class="form-group col-xs-12 col-md-8" style="{if $enable_comment == '0'}display: none;{/if}">
            <label for="comment">Comentario:</label>
            <textarea name="comment" id="comment" class="formcontrol"></textarea>
        </div>
        <div class="submit fotocliente_bloque">
            <button type="submit" name="fotocliente_submit_foto" class="button btn btn-success button-medium">
                <span>Enviar <i class="icon-chevron-right right"></i></span>
            </button>
        </div>
    </form>
</div>