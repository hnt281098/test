<script>
$(document).ready(function(){

    // A Click
    $('a[rel=edit]').click(function(){
        var elementId = $(this).attr('element-id');
        var pageId = $(this).attr('page-id');

        $('anchor[id="dsp_'+elementId+'"]').hide();
        $('#grp_input_'+elementId).show();
    });


    $('button[rel=btn-save]').click(function(){
        var elementId = $(this).attr('data-field');
        var content = $('#input_'+elementId).val();

        $.get('/admin/page/access?field='+elementId+'&content='+encodeURIComponent(content), function(resp){
            if(resp.error == 0){
                $('anchor[id="dsp_'+elementId+'"]').find('desc').text(content);
                $('anchor[id="dsp_'+elementId+'"]').show();
                $('#grp_input_'+elementId).hide();
            }
        },'json');
    });

});
</script>