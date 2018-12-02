$(function () {
   // select form
    $('body').on('submit','#form-bc',function (e) {
        e.preventDefault();
        var $form = $('#form-bc').attr('action');
        var $method = $('#form-bc').attr('method')
        var $token = $('input[name="_token"]').val();
        var $product = $('#bc-product').val();
        if($product.length !== 0){
            $('#target-list-product').show();
            $.ajax({
                method: $method,
                url: $form,
                data: {'product' : $product,"_token":$token},
                beforeSend: function() {
                    $('#target-list-product').html('<div class="col-xs-12 text-center"><i class="fa fa-spin fa-2x fa-spinner"></i></div>')
                },
                error: function (data) {
                  console.log(data)
                },
                success: function (data) {
                    $('#target-list-product').html(data)
                }
            })
        }else{
            $('#target-list-product').hide();
        }

    });
    $('body').on('click','.bc-add',function (e) {
       var $qt = $('#bc-qt').val();
       var $qt_input = $('#qt-product-' + $(this).attr('id'));
        $qt_input.val($qt);
       $('#form-'+ $(this).attr('id')).submit();
    });
    $('body').on('click','.add-product',function (e) {
        e.preventDefault();
        var $target = $(this).attr('data-target');
        $($target).show();
    })

    // bc add
    $('body').on('click','.add-bc-sale',function () {
        var $purchased = $(this).attr('data-target');
        var $max = $(this).attr('data-title');
        var $name = $(this).attr('data-content');
        $('#bc-form tbody').append().text(form_bc($purchased,$max))
        alert('ok');
    })
    function form_bc($purchased,$max){
        var $pu = "<td><input type='number' title='pu' name='pu["+$purchased+"]' class='form-control' placeholder='PU' required></td>";
        var $qt = "<td><input type='number' title='qt' name='qt["+$purchased+"]' min='1' max='"+$max+"' class='form-control' placeholder='QT' required></td>"
        return "<tr>"+$pu + $qt +"</tr>"
    }
});
