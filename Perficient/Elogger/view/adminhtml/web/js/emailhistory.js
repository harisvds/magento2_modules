/**
 * Created by Harishankar.Malviya on 6/8/2016.
 */

require([
        'jquery',
        'Magento_Ui/js/modal/alert'
    ],
    function($, modal) {

        $('.viewHistory').on('click', function(event){
            modal({
                title: 'Email Detail',

                content: '<div class="modal-content"></div>'
            })
            $.ajax({
                url: "index/detail",
                data: {email_id: $(this).attr('data-attr')},
                type: 'post',
                dataType: 'json',
                showLoader: true,
               // context: $('#edit_form')
            }).done(function(data){

                html='<div class="row"><span><strong>Sender:</strong></span><span>'+data.data['sender']+'</span></span></div>'
                html+='<div class="row"><span><strong>Receiver:</strong></span><span>'+data.data['receiver']+'</span></span></div>'
                html+='<div class="row"><span><strong>Subject:</strong></span><span>'+data.data['subject']+'</span></span></div>'
                html+='<div class="row"><span><strong>Description:</strong></span><span>'+data.data['description']+'</span></span></div>'
                $('.modal-content').empty().append(html);
              //  console.log();
            });

        })
    }
);
