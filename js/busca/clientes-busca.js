$(document).ready(function () {

    var   txt_busca = $("#input-search"),
          form_busca = $("#form-search"),
          carregar = $("#form-lista");

    txt_busca.keyup(function () {

        if (txt_busca == "") {
            //CARREGA A PAGINA INICIAL
        } else {
            $.ajax({
                type: 'POST',
                url: 'pagina/busca/clientes-busca.php',
                data: form_busca.serialize(),
                success: function (data) {
                    carregar.html(data);
                }
            });
        }
    });
});