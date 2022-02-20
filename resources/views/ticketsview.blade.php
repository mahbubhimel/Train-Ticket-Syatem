<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tickets</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
<div class="row">
    <div class="col">
        <h3>Tickets Data</h3>
        <label>Per Page</label>

        <input id="per_page_input" value="1">


        <label>Pages</label>

        <select id="current_page_input">
            <option value="0">Page-1</option>
            <option value="1">Page-2</option>
        </select>



        <button id="nextPageBtn">Next Page</button>
        <table>
            <thead>
            <th>Name</th>
            <th>From</th>
            <th>To</th>
            <th>Real Price</th>
            <th>Covid Price</th>
            <th>Total Price</th>
            </thead>
            <tbody id="ticket-list-body">

            </tbody>


        </table>
    </div>

</div>
</body>

<script>
    function getData() {
        var current_page_value = $('#current_page_input').val();
        var per_page_value = $('#per_page_input').val();
        $.ajax({
            url: 'ticket-data',
            type: 'GET',
            data: {current_page: current_page_value, per_page: per_page_value},

            success: function (res) {
                var html = '';
                $('#ticket-list-body').html('')
                res.data.map(row => {
                    console.log(typeof (res));
                    html += '<tr>';
                    html += '<td>' + row.name + '</td>';
                    html += '<td>' + row.name + '</td>';
                    html += '<td>' + row.name + '</td>';
                    html += '<td>' + row.name + '</td>';
                    html += '<td>' + row.name + '</td>';
                    html += '<td>' + row.total_price + '</td>';
                    html += '</tr>';

                })
                $('#ticket-list-body').html(html)


            }

        })
    }

    getData();

    $('#nextPageBtn').on('click', function () {
        getData();
    })


</script>


</html>

