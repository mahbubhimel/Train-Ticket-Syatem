<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tickets</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <?php if(session()->has('message')): ?>
        <div class="alert alert-success">
            <?php echo e(session()->get('message')); ?>

        </div>
    <?php endif; ?>
    
    
    
    
    
    <div class="card text-center">
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
            <?php echo e(session()->get('time')); ?>

        </div>
    </div>

</div>




</body>

<script>
    var user = <?php echo \Illuminate\Support\Facades\Auth::user(); ?>


    document.getElementById('user-name').innerHTML = 'Congratulations ' + user.name;

    var id = <?php echo e(session()->get('data')); ?>;
    var time = new Date();
    time.setDate(time.getDate() + 10);


    $.ajax({
        url: 'purchased-details',
        type: 'GET',
        data: {train_id: id},

        success: function (res) {
            console.log(res.data[0].name);
            document.getElementById('train-name').innerHTML = 'You have purchased ticket of ' + res.data[0].name;
            document.getElementById('from-to').innerHTML =   'You will be travelling from ' + res.data[0].from + ' to ' + res.data[0].to;
            document.getElementById('date').innerHTML = 'Your Journey Date: ' + time;


        }

    })

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

<?php /**PATH D:\laravel projects\blog\resources\views/purchase.blade.php ENDPATH**/ ?>