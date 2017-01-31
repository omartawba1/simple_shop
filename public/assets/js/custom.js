$("#search").on("submit", function (e) {
    e.preventDefault();
    $("[type='submit']").button('loading');
    var default_row = "<tr><td colspan='5'>No data for displaying</td></tr>";
    $.ajax({
        url: $(this).attr('action'),
        data: "query="+$("[name='query']").val(),
        processData: false,
        contentType: false,
        success: function (msg) {
            var json = $.parseJSON(msg);
            var content = '';
            $.each(json, function (key, item) {
                content += "<tr><td>" + item.name + "</td><td>" + item.price + "</td><td><img src='" + item.image_url + "' /></td><td>" + item.msrp + "</td><td>" + item.percentage + "</td></tr>";
            });
            $("table#results tbody").html(content);
            $("[type='submit']").button('reset');
        },
        error: function (msg) {
            alert('Sorry no data for your search query');
            $("table#results tbody").html(default_row);
            $("[type='submit']").button('reset');
        }
    });
});