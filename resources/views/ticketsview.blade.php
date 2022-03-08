<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tickets</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @extends('layout.head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col" id="ticket-list-id">
            <h3>Ticket Data</h3>
            <table class="table">
                <thead>
                <tr>

                    <th scope="col">Name</th>
                    <th scope="col">From</th>
                    <th scope="col">To</th>
                    <th scope="col">Ticket Price</th>
                    <th scope="col">Purchase Status</th>
                </tr>
                </thead>
                <tbody id="ticket-list-body">

                </tbody>
            </table>
        </div>

    </div>

    <div class="alert alert-danger" style="display: none"></div>

    <hr>


    <div class="card text-center" id="purchaseDetailsID" style="display: none">
        <div class="card-header">

            Purchased Ticket Details!
        </div>
        <div class="card-body">
            <h5 class="card-title" id="user-name">x</h5>
            <p class="card-text" id="train-name">With supporting text below as a natural lead-in to additional
                content.
            </p>
            <p class="card-text" id="from-to">With supporting text below as a natural lead-in to additional
                content.
            </p>
            <p class="card-text" id="date">With supporting text below as a natural lead-in to additional
                content.
            </p>
            <a href="/home" class="btn btn-primary">Home</a>
        </div>
        <div class="card-footer text-muted">
            {{date("d-m-Y")}}
        </div>
    </div>
</div>


</body>

<script>

    var id = {!! json_encode($id) !!}; //convert array into json representation

    var user = {!! \Illuminate\Support\Facades\Auth::user() !!};



    function getData() {

        $.ajax({
            url: '/tickets/ticket-data',
            type: 'GET',
            data: {id: id},

            success: function (res) {
                var x = "BUY TICKET"
                // console.log(res.data);
                if (res.data.length > 0) {
                    var html = '';
                    $('#ticket-list-body').html('')
                    res.data.map(row => {
                        {{--var url = '{{url("/")}}/purchased/?id=' + row.id+'&user=' + user.id+'&user_name=' + user.name+'&train_id=' + row.train_id;--}}
                        {{--var url = '{{url("/")}}/tickets/?id=' + row.id;--}}
                        console.log(typeof (res));
                        html += '<tr>';
                        html += '<td>' + row.name + '</td>';
                        html += '<td>' + row.from + '</td>';
                        html += '<td>' + row.to + '</td>';
                        html += '<td>' + row.total_price + '</td>';
                        html += '<td>' + row.purchase_status + '</td>';
                        html += '<td>' + '<a href="#" data-id=" ' + row.id + ' "onclick="getPurchasedData(this)" id="buyID_' + row.id + '">' + x + '</a>' + '</td>';
                        html += '</tr>';

                    })
                    $('#ticket-list-body').html(html)
                    $('.alert').hide();
                } else {
                    // alert("no tickets available right now");
                    $('.alert').show()
                    $('.alert').html("No Tickets Available Right Now");
                    $('#ticket-list-body').html('')
                }


            }

        })


    }

    getData();


    function getPurchasedData(e) {

        //here id is ticket id
        var id = $(e).data('id');
        // var name = $(e).data('&user')
        // console.log(id);


        function getDataOne() {



            $.ajax({
                url: '/purchased',
                type: 'GET',
                data: {id: id},

                success: function (res) {

                    console.log(res.train_ID);
                    getData();

                    purchaseMessage(res.train_ID)
                }

            })
        }

        getDataOne();

        $('#purchaseDetailsID').show();


    }

    function purchaseMessage(id){
        var time = new Date();
        time.setDate(time.getDate() + 10);

        console.log("train id inside ajax" , id);
        document.getElementById('user-name').innerHTML = 'Congratulations ' + user.name;


        $.ajax({
{{--            '{{route('/purchased-details')}}',--}}
            url: '{{url('/purchased-details')}}',
            type: 'GET',
            data: {train_id: id},

            success: function (res) {
                console.log("this is res ", res)
                console.log(res.data[0].name);
                document.getElementById('train-name').innerHTML = 'You have purchased ticket of ' + res.data[0].name;
                document.getElementById('from-to').innerHTML =   'You will be travelling from ' + res.data[0].from + ' to ' + res.data[0].to;
                document.getElementById('date').innerHTML = 'Your Journey Date: ' + time;


            }

        })
    }

    // $('#buyID').on('click', function (){
    //     $('#purchaseDetailsID').show();
    //     // $('#ticket-list-id').hide();
    //     console.log("button clicked")
    //     // $('.alert').hide();
    //     // getData();
    // })


</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>



</html>

