<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tickets</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @extends('layout.head')

</head>
<body>
<div class="container">
    <div class="row">
        <div class="form-group col-sm">
            <label for="name">Train Name:</label>
            <input type="text" class="form-control" id="train-name">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm">
            <label for="from">From</label>
            <input type="text" class="form-control" id="from">

        </div>
        <div class="form-group col-sm">
            <label for="to">TO</label>
            <input type="text" class="form-control" id="to">
        </div>


    </div>
    <hr/>

    <div class="text-center">
        <button type="button" class="btn btn-info btn-lg" id="findBtn">Find Information</button>
    </div>
    <hr>
    <div class="row">
        <div class="col">
            <h3>Tickets Data</h3>
            <table class="table">
                <thead>
                <tr>

                    <th scope="col">Name</th>
                    <th scope="col">From</th>
                    <th scope="col">To</th>
                </tr>
                </thead>
                <tbody id="train-list-body">

                </tbody >
            </table>
        </div>

    </div>
</div>
</body>

<script>
    function getTrainData() {
        var tr_name = $('#train-name').val();
        var tr_from = $('#from').val();
        var tr_to = $('#to').val();
        console.log(tr_name, tr_from, tr_to);

        $.ajax({
            url: "{{route('train-data')}}",
            type: 'GET',
            data: {train_name: tr_name, from: tr_from, to: tr_to},

            success: function (res) {
                console.log(res);
                // var html = '';
                // $('#train-list-body').html('')
                // res.data.map(row => {
                //     console.log(res);

                    // html += '<tr>';
                    // html += '<td>' + row.name + '</td>';
                    // html += '<td>' + row.from + '</td>';
                    // html += '<td>' + row.name + '</td>';
                    //
                    // html += '</tr>';

                // })

                // console.log(res);
                // $('#train-list-body').html(html)


            }

        })
    }

    getTrainData();

    $('#findBtn').on('click', function () {
        getTrainData();
    })
</script>
</html>

