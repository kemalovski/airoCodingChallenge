<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <title>User Handle</title>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col">
    <h3>Get Token Form</h3>
        <form id="getTokenForm">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <button id="getTokenButton" type="button" class="btn btn-primary">Submit</button>
        </form>
        
        
    </div>
    <div class="col">
        <form>
            <div class="form-group">
                <label for="getTokenResponse">Get Token Form Response</label>
                <textarea class="form-control" id="getTokenResponse" name="getTokenResponse" cols="30" rows="10">Get Token Response</textarea>
            </div>
        </form>
    </div>
  </div>
</div>
<hr/>

<div class="container">
  <div class="row">
    <div class="col">
        <h3>Quotation Form</h3>
        <form id="quotationForm">
            <div class="form-group">
                <label for="age">Jwt Token</label>
                <input type="text" class="form-control" id="jwtToken" name="jwtToken" placeholder="Enter YOUR JWT TOKEN">
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="text" class="form-control" id="age" name="age" placeholder="Enter ages">
            </div>
            <div class="form-group">
                <label for="currency_id">Currency Id</label>
                <input type="text" class="form-control" id="currency_id" name="currency_id" placeholder="Enter currency">
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="text" class="form-control" id="start_date" name="start_date" placeholder="start date">
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="text" class="form-control" id="end_date" name="end_date" placeholder="end date">
            </div>
            <button id="quotationButton" type="button" class="btn btn-primary">Submit</button>
        </form>
        
        
    </div>
    <div class="col">
        <form>
            <div class="form-group">
                <label for="quotationFormResponse">Quotation Form Response</label>
                <textarea class="form-control" id="quotationFormResponse" name="quotationFormResponse" cols="30" rows="10">Quotation Form Response</textarea>
            </div>
        </form>
    </div>
  </div>
</div>
    
    <script>
        $(document).ready(function(){
            $("#getTokenButton").click(function(){
                $.post(
                    "/api/register",
                    $( "#getTokenForm" ).serialize(), 
                    function(data, status){
                        $("#getTokenResponse").val(JSON.stringify(data, null, "\t"));
                    });
            });
            
            
            $("#quotationButton").click(function(){

                var jwtToken = 'Bearer '+$("#jwtToken").val();
                
                $.ajax({
                    url: '/api/quotation',
                    headers: {
                        'Authorization':jwtToken,
                        'Content-Type':'application/json'
                    },
                    method: 'POST',
                    data: JSON.stringify({
                        "age": $("#age").val(),
                        "currency_id": $("#currency_id").val(),
                        "start_date": $("#start_date").val(),
                        "end_date": $("#end_date").val()
                    }),
                    success: function(data){
                        $("#quotationFormResponse").val(JSON.stringify(data));
                    }
                });
            });
        });


    </script>
  </body>
</html>