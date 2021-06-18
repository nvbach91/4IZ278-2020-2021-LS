<script>
$(document).ready(function(){

$("#university").change(function(){
    var uniid = $(this).val();

    $.ajax({
        url: 'getDorm.php',
        type: 'post',
        data: {uni:uniid},
        dataType: 'json',
        success:function(response){

            var len = response.length;
            $("#dormitory").empty();
            $("#dormitory").append("<option style='display:none'></option>");

            for( var i = 0; i<len; i++){
                var id = response[i]['id'];
                var name = response[i]['name'];
                
                $("#dormitory").append("<option value='"+id+"'>"+name+"</option>");

            }
        }
    });
});

})
</script>
