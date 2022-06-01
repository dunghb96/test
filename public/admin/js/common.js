function commonAlert(message) {
    Swal.fire(
        message,
        '',
        'warning'
    )
}

function commonConfirm(message, ids, callback) {
    Swal.fire({
        title: '',
        text: "",
        icon: 'warning',
        html: '<div class="mb-3 show_cris_no"style="width: 80%; margin: auto;" >' + ids + '</div><center><div style="margin-bottom: 0">'+message+'</div></center>',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'いいえ',
        confirmButtonText: 'はい'
    }).then(callback)
}

function actionDelete(event) {
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let id = $(this).data('id');
    commonConfirm('請求書情報を削除してよろしいですか。', '', (result) => {
        if (result.isConfirmed && result.value) {
            $('.loading-overlay').show()
            $.ajax({
                type: 'Post',
                url: urlRequest,
                data: {
                    id: id
                },
                success: function (data){
                    if (data.code==200){
                        location.reload();
                    }
                },
                error: function (){
                    location.reload();
                }
            })
        }
    });
}
$(function (){
    $(document).on('click','.action_delete ',actionDelete);
    setTimeout(function() { $(".js-auto-close").remove()}, 6000);// auto close
})
