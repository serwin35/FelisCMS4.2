// Aktywowanie wpisu
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
$(".actions").on("click", "a.glyphicon-ok", function(event){
=======
$(".actions").on("click", "a.coquette16-accept", function(event){
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
$(".actions").on("click", "a.coquette16-accept", function(event){
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
$(".actions").on("click", "a.coquette16-accept", function(event){
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
    event.preventDefault();
    var id =($(this).attr('data-item'));
    var url = "{$base_url}pages/active.html";

    $.ajax({
        url: url,
        type: "POST",
        dataType: 'json',
        data: {
            "date[id]":id
        },
        success: function(response) {
            //console.log(response);
            if (response.status == 'ok') {
                notify('{lang line="default_success"}', "{lang line='default_item_active'}", {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                    icon: '{$TEMPLATES}assets/img/icons/woocons/glyph-check.png'
                });
                $("#status_"+id).removeClass("glyphicon-ok").addClass("glyphicon-ban-circle").attr("title","{lang line='default_block'}");
            } else{
                notify('{lang line="default_error"}', "{lang line='default_item_active_error'}", {
                    icon: '{$TEMPLATES}assets/img/icons/woocons/stop.png'
=======
=======
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
                    icon: '{$base_url}public/img/icons/coquette/48x48/accept.png'
                });
                $("#status_"+id).removeClass("coquette16-accept").addClass("coquette16-block").attr("title","{lang line='default_block'}");
            } else{
                notify('{lang line="default_error"}', "{lang line='default_item_active_error'}", {
                    icon: '{$base_url}public/img/icons/coquette/48x48/warning.png'
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
                });
            }
        },
      error: function(){
        notify('{lang line="default_error"}', "{lang line='default_item_active_error'}", {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            icon: '{$TEMPLATES}assets/img/icons/woocons/stop.png'
=======
            icon: '{$base_url}public/img/icons/coquette/48x48/warning.png'
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
            icon: '{$base_url}public/img/icons/coquette/48x48/warning.png'
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
            icon: '{$base_url}public/img/icons/coquette/48x48/warning.png'
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
        });
      }
    });
});
// .end


// Blokowanie wpisu
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
$(".actions").on("click", "a.glyphicon-ban-circle", function(event){
=======
$(".actions").on("click", "a.coquette16-block", function(event){
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
$(".actions").on("click", "a.coquette16-block", function(event){
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
$(".actions").on("click", "a.coquette16-block", function(event){
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
    event.preventDefault();
    var id =($(this).attr('data-item'));
    var url = "{$base_url}pages/block.html";

    $.ajax({
        url: url,
        type: "POST",
        dataType: 'json',
        data: {
            "date[id]":id
        },
        success: function(response) {
            //console.log(response);
            if (response.status == 'ok') {
                notify('{lang line="default_success"}', "{lang line='default_item_block'}", {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                    icon: '{$TEMPLATES}assets/img/icons/woocons/glyph-check.png'
                });
                $("#status_"+id).removeClass("glyphicon-ban-circle").addClass("glyphicon-ok").attr("title","{lang line='default_active'}");
            } else{
                notify('{lang line="default_error"}', "{lang line='default_item_block_error'}", {
                    icon: '{$TEMPLATES}assets/img/icons/woocons/stop.png'
=======
=======
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
                    icon: '{$base_url}public/img/icons/coquette/48x48/accept.png'
                });
                $("#status_"+id).removeClass("coquette16-block").addClass("coquette16-accept").attr("title","{lang line='default_active'}");
            } else{
                notify('{lang line="default_error"}', "{lang line='default_item_block_error'}", {
                    icon: '{$base_url}public/img/icons/coquette/48x48/warning.png'
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
                });
            }
        },
      error: function(){
        notify('{lang line="default_error"}', "{lang line='default_item_block_error'}", {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            icon: '{$TEMPLATES}assets/img/icons/woocons/stop.png'
=======
            icon: '{$base_url}public/img/icons/coquette/48x48/warning.png'
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
            icon: '{$base_url}public/img/icons/coquette/48x48/warning.png'
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
            icon: '{$base_url}public/img/icons/coquette/48x48/warning.png'
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
        });
      }
    });
});
// .end

// Usuwanie wpisu
$('.actions .felisDel').data('confirm-options', {

    onConfirm: function()
    {
        // Remove element
        var url = "{$base_url}pages/del.html",
            idItem = $(this).attr("data-item"),
            thisTr = $(this).closest('tr');

        $.ajax({
            url: url,
            type: "POST",
            dataType: 'json',
            data: {
                "date[id]":idItem
            },
            success: function(response) {
                //console.log(response);
                if (response.status == 'ok') {
                    thisTr.fadeAndRemove(),
                    notify('{lang line="default_success"}', "{lang line='default_item_delete'}", {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                        icon: '{$TEMPLATES}assets/img/icons/woocons/glyph-check.png'
                    });
                } else{
                    notify('{lang line="default_error"}', "{lang line='default_item_block_delete'}", {
                        icon: '{$TEMPLATES}assets/img/icons/woocons/stop.png'
=======
=======
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
                        icon: '{$base_url}public/img/icons/coquette/48x48/accept.png'
                    });
                } else{
                    notify('{lang line="default_error"}', "{lang line='default_item_block_delete'}", {
                        icon: '{$base_url}public/img/icons/coquette/48x48/warning.png'
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
                    });
                }
            },
          error: function(){
            notify('{lang line="default_error"}', "{lang line='default_item_block_delete'}", {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                icon: '{$TEMPLATES}assets/img/icons/woocons/stop.png'
=======
                icon: '{$base_url}public/img/icons/coquette/48x48/warning.png'
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
                icon: '{$base_url}public/img/icons/coquette/48x48/warning.png'
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
=======
                icon: '{$base_url}public/img/icons/coquette/48x48/warning.png'
>>>>>>> e18296fc5b298591503bc7cdc3e4969c60a8b49c
            });
          }
        });

        // Prevent default link behavior
        return false;
    }

});
// .end

// Kopiowanie tytułu strony

//.end