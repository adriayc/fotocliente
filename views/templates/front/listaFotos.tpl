<h2>Listado con todas las fotos del modulo fotocliente</h2>
{foreach from=$fotos item=foto}
    <div class="fotocliente_bloque col-xs-12">
        {if $enable_comment == '1'}
            <div class="fotocliente_comment col-xs-12">{$foto.comment}</div>
        {/if}
        <img src="{$base_dir}{$foto.foto}" class="fotocliente_comment col-xs-12" alt="">
    </div>
{/foreach}