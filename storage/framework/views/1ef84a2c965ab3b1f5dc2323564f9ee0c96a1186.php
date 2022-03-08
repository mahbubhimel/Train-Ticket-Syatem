<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tickets</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    

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



</div>
</body>

<script>

    

    var user = <?php echo \Illuminate\Support\Facades\Auth::user(); ?>;


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


<?php echo $__env->make('layout.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel projects\blog\resources\views/purchaseHistory.blade.php ENDPATH**/ ?>