<script type="text/javascript">

            $(".toggle").click(function() {
                toggleData($(this).prop('checked'));
            });

            //$(".add").click(function(){

            //    var id = $(this).attr("value");
            //    addData(id);
            //});

            //$(".view").click(function(){

            //    var id = $(this).attr("value"); 
            //    viewData(id);
            //});
    
            //$(".edit").click(function(){

            //    var id = $(this).attr("value"); 
            //    editData(id);
            //});
			    
            //$(".delete").click(function(){

            //    var id = $(this).attr("value");
            //    deleteData(id);
            //});  
            
            function toggleData(source) 
            {
              var checkboxes = document.getElementsByName('dataID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source;
                    }
            }               
            
            function getChecks(){

                var checkboxes = $("[name='dataID[]']");
               
                var ids = [];

                $.each( checkboxes, function( key, checkbox ) {
                      if(checkbox.checked===true) {
                        ids.push(checkbox.value); 
                      }
                });
                
                return ids;
            }

</script>