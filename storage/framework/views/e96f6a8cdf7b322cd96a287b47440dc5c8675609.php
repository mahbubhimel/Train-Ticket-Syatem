<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tickets</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    

</head>
<body>
<div class="container">






<!-- Example single danger button -->


    <div class="row">
        <div class="form-group col-sm">
            <label for="from">FROM</label>
            <select class="form-control" id="from">
                <option id="DHK">DHK</option>
                <option id="CTG">CTG</option>
                <option id="KHL">KHL</option>
                <option id="COM">COM</option>
            </select>
        </div>
        
        
        
        
        <div class="form-group col-sm">
            <label for="to">TO</label>
            <select class="form-control" id="to">
                <option id="DHK">DHK</option>
                <option id="CTG" >CTG</option>
                <option id="KHL">KHL</option>
                <option id="COM">COM</option>
            </select>
        </div>


    </div>
    <hr/>

    <div class="row">
        <div class="text-center col-sm">
            <button type="button" class="btn btn-info btn-lg" id="findBtn">Find Information</button>
        </div>
        <div class="text-center col-sm">

            <a>
                <button type="button" class="btn btn-success btn-lg" id="purchaseBtn">Purchase History</button>
            </a>
        </div>
    </div>
    <hr>


    <div class="alert alert-danger" style="display: none"></div>



    <div class="row" id="train-list" style="display: none">
        <div class="col">
            <h3>Train Data</h3>
            <table class="table">
                <thead>
                <tr>

                    <th scope="col">Name</th>
                    <th scope="col">From</th>
                    <th scope="col">To</th>
                    <th scope="col">Number of Tickets</th>
                </tr>
                </thead>
                <tbody id="train-list-body">

                </tbody>
            </table>
        </div>

    </div>

    <div class="row" id="purchaseID" style="display: none">
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

    function values_of_from(){
        var train_from = $('#from').val();
        var train_to = $('#to').val();
    }
    var temp=[];

    $('#from').on('change', function (){
        values_of_from();
        if(temp.length >0){
            var tempNode=temp.pop().css('display','block');
        }

        $("#to option").each(function () {
            //console.log($(this).val());
            if($(this).val() ===  $('#from').val()){
                $("#to option[id='"+$(this).val()+"'").css('display','none');
                //console.log($("#to option[id='"+$(this).val()+"'").css('display','none')) ;
                temp.push($("#to option[id='"+$(this).val()+"'"))
            }
        })
    })

    var temp1= [];

    $('#to').on('change', function (){
        values_of_from();
        if(temp1.length >0){
            var tempNode=temp1.pop().css('display','block');
        }

        $("#from option").each(function () {
            //console.log($(this).val());
            if($(this).val() ===  $('#to').val()){
                $("#from option[id='"+$(this).val()+"'").css('display','none');
                //console.log($("#to option[id='"+$(this).val()+"'").css('display','none')) ;
                temp1.push($("#from option[id='"+$(this).val()+"'"));
            }
        })
    })


    function getTrainData() {

        var tr_name = $('#train-name').val();
        var tr_from = $('#from').val();
        var tr_to = $('#to').val();

        $.ajax({
            url: 'train-data',
            type: 'GET',
            data: {train_name: tr_name, from: tr_from, to: tr_to},

            success: function (res) {
                console.log(res);
                if (res.data.length > 0) {
                    var html = '';
                    $('#train-list-body').html('');
                    res.data.map(row => {
                        var url = '<?php echo e(url("/")); ?>/tickets/?id=' + row.id;
                        html += '<tr>';
                        html += '<td>' + '<a href="' + url + '">' + row.name + '</a>' + '</td>';
                        html += '<td>' + row.from + '</td>';
                        html += '<td>' + row.to + '</td>';
                        html += '<td>' + row.number_of_tickets + '</td>';
                        html += '</tr>';

                    })

                    console.log(res);
                    $('#train-list-body').html(html);
                    $('.alert').hide();
                } else if (tr_from == tr_to) {
                    html = '';
                    $('#train-list-body').html(html);
                    $('.alert').show()
                    $('.alert').html("Wrnog Input! Try Again");


                    // alert("Wrnog Input! Try Again");
                } else {
                    html = '';
                    $('#train-list-body').html(html);
                    $('.alert').show()
                    $('.alert').html("No Trains Available!");
                }
            }

        })
    }

    function get_purchaseHistory_Data() {

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
                        var url = '<?php echo e(url("/")); ?>/purchased/?id=' + row.id+'&user=' + user.id+'&user_name=' + user.name+'&train_id=' + row.train_id;
                        var url = '<?php echo e(url("/")); ?>/tickets/?id=' + row.id;
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
                    $('.alert').hide();

                }
                else {
                    // alert("No purchase history!");
                    $('.alert').show();
                    $('.alert').html("No purchase history!");
                }

            }

        })
    }




    $('#findBtn').on('click', function () {
        getTrainData();
        $('#purchaseID').hide();
        console.log("button clicked from find button")
        $('#train-list').show();
    })

    $('#purchaseBtn').on('click', function (){
        get_purchaseHistory_Data();
        $('#train-list').hide();
        $('#purchaseID').show();

        console.log("button clicked from purchase button")

    })



</script>

</html>


<?php echo $__env->make('layout.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel projects\blog\resources\views/tickets.blade.php ENDPATH**/ ?>