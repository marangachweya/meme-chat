var from = null, start = 0, url = '/chat/chat-server.php';
$(document).ready(function () {

    from = prompt("Please enter your name");
    load();

    $('form').submit(function (e) {
        $.post(url, {
            message: $('#message').val(),
            from: from

        });
        $('#message').val('');
        return false;
    })

})

function load() {
    $.get(url + '?start=' + start, function (result) {
        if (result.items) {
            result.items.forEach(item => {
                start = item.id;
                $('#messages').append(renderMessage(item));
            })
        };
        // load();
    });
    $('#messages').animate({ scrollTop: $('#messages')[0].scrollHeight });
}

function renderMessage(item) {
    let time = new Date(item.created);
    return '<div class="msg"><p>'+ item.from+'</p>'+item.message+'<span>'+time+'</span></div>';
}

