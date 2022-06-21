
ClassicEditor
.create( document.querySelector( '.editor' ) )
.catch( error => {
    console.log( error );
} );

$(function() {
    if( $( ".todo-page" ).length ) {                
        $( ".to-do-checkbox" ).on('click', function() {            
            $this = $(this);
            $.ajax({
                url: $siteUrl + "/?action=update-todolist-status",
                method: "post",
                data: { todoid: $this.val(), status: $this.prop("checked") },
                success: function(response) {
                    if(response == "1") {                        
                        $this.parent().parent().parent().parent().removeClass('alert-success');
                        $this.parent().parent().parent().parent().removeClass('alert-warning');
                        if( $this.prop("checked") ) {
                            $this.parent().parent().parent().parent().addClass('alert-success');
                            $this.parent().children("label").addClass('text-decoration-line-through');
                        } else {
                            $this.parent().parent().parent().parent().addClass('alert-warning');
                            $this.parent().children("label").removeClass('text-decoration-line-through');
                        }
                    }
                }
            });
        });
    }
});

