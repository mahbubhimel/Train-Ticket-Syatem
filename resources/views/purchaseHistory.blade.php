<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
        <div class="col-sm">
            <h3>Purchase History</h3>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">User Name</th>
                    <th scope="col">Train</th>
                    <th scope="col">From</th>
                    <th scope="col">To</th>
                    <th scope="col">Price</th>
                    <th scope="col">Journey Date</th>
                </tr>
                </thead>
                <tbody id="purchase-list-body">

                </tbody>
            </table>
        </div>

    </div>

{{--    <div class="alert alert-danger" style="display: none"></div>--}}

</div>
</body>

<script>

    {{--var id = {!! json_encode($id) !!}; //convert array into json representation--}}

    var user = {!! \Illuminate\Support\Facades\Auth::user() !!};


    function getData() {

        $.ajax({
            url: 'get-history',
            type: 'GET',
            data: {id : user.id},

            success: function (res) {
                console.log(res.data[0]);
                if (res.data.length >0) {
                    var html = '';
                    $('#ticket-list-body').html('')
                    res.data.map(row => {
                        {{--var url = '{{url("/")}}/purchased/?id=' + row.id+'&user=' + user.id+'&user_name=' + user.name+'&train_id=' + row.train_id;--}}
                        {{--var url = '{{url("/")}}/tickets/?id=' + row.id;--}}
                        console.log(typeof (res));
                        html += '<tr>';
                        html += '<td>' + row.user_name + '</td>';
                        html += '<td>' + row.name + '</td>';
                        html += '<td>' + row.from + '</td>';
                        html += '<td>' + row.to + '</td>';
                        html += '<td>' + row.real_price + '</td>';
                        html += '<td>' + row.journey_date + '</td>';

                        html += '</tr>';

                    })
                    $('#purchase-list-body').html(html);
                    // $('.alert').hide();

                }
                else {
                    // alert("No purchase history!");
                    $('.alert').show();
                    // $('.alert').html("No purchase history!");
                }

            }

        })
    }

    getData();


</script>


</html>

