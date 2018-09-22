{*<h3>Esta es la configuracion del modulo</h3>*}

<fieldset>
    <h2>Configuracion del modulo de Fotos de Clientes</h2>
    <div class="panel">
        <div class="panel-heading">
            <legend><img src="../img/admin/cog.gif" alt=""> Configuracion</legend>
        </div>
        <form action="" method="post">
            <div class="form-group clearfix">
                <label for="" class="col-lg-3">Añadir comentario:</label>
                <div class="col-lg-9">
                    <img src="../img/admin/enabled.gif" alt="">
                    <input type="radio" name="enable_comment" id="enable_comment_1" value="1">
                    <label for="enable_comment_1" class="t">Si</label>

                    <img src="../img/admin/disabled.gif" alt="">
                    <input type="radio" name="enable_comment" id="enable_comment_0" value="0">
                    <label for="enable_comment_0" class="t">No</label>
                </div>
            </div>
            <div class="panel-footer">
                <input class="btn btn-default pull-right" type="submit" name="fotoclient_form" value="Guardar">
            </div>
        </form>
    </div>
</fieldset>