/* ===================================================================
    Author          : MarketingOptimaal
    Version         : 1.1c
====================================================================== */

// switchSubmit()
  function switchSubmit(){
    if($("input#akkoordcheck").prop("checked")) {
      $("button#frmSubmit").prop('disabled', false);
    } else {
      $("button#frmSubmit").prop('disabled', true);
    }
  }
  $(document).ready(function(){
      switchSubmit();
      $("input#akkoordcheck").change(switchSubmit);
  });
