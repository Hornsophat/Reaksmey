//multi room
$("#room_no").on("change", function() {
  var room_id = $(this).val();
  $.ajax({
    type : "GET",
    dataType : "json",
    data : dataString,
    url : "<?php echo site_url('admin/room/?room_id='); ?>" + room_id,
    async : false,
    success : function(result) {
      try {
        var $el = $("#multi_room");
       
      } catch(e) {
        alert("Exception while request..");
      }
    },
    error : function() {
      alert('Sorry Nothing Found For Staying Time!!!');
    }
  });
});
