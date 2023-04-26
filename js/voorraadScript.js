$(document).ready(function(){
    $('#merk').on('change', function(){
        var autoMerk = $(this).val();

        if(autoMerk == 'Alles'){
          $('.modelselector').html('<option value="">Selecteer eerst een merk</option>');
          console.log(autoMerk);
        }else if(autoMerk){
            $.ajax({
                type:'POST',
                url:'includes/ajax/getModelData.php',
                data:'auto_merk='+autoMerk,
                success:function(modelRows){
                    $('.modelselector').html(modelRows);
                }
            }); 
        }else{
            $('.modelselector').html('<option value="">Selecteer eerst een merk</option>');
        }
    });
});
$(document).ready(function(){

    load_more_data(0);

      $(window).on('scroll',function(){
          var lastId = $('.loader').attr('id');

          if(($(window).scrollTop() == $(document).height() - $(window).height()) && (lastId != 0)){
              load_more_data(lastId);
          }
      });

      function load_more_data(lastId){
          $.ajax({
              type:'GET',
              url:'includes/ajax/voorraad.php',
              dataType:'html',
              cache: true,
              data:{last_id:lastId},
              beforeSend:function(){
                  $('.loader').show();
              },
              success:function(data){
                  setTimeout(function() {
                    $('.loader').remove();
                    $('#skeleton').remove();
                    $('#skeleton1').remove();
                    $('#skeleton2').remove();
                    $('#skeleton3').remove();
                  $('#load_data').append(data);
                  },200);
                  
              }
          });
      }
  });