<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Bootstrap Modal CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="CompleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="completename" class="form-label">Name</label>
                        <input type="text" class="form-control" id="completename" placeholder="enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="completeemail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="completeemail" placeholder="enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="completemobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="completemobile"
                            placeholder="enter your mobile number">
                    </div>
                    <div class="mb-3">
                        <label for="completeplace" class="form-label">Place</label>
                        <input type="text" class="form-control" id="completeplace" placeholder="enter your place">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick="adduser()">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- update model -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="updatename" class="form-label">Name</label>
                        <input type="text" class="form-control" id="updatename" placeholder="enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="updateemail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="updateemail" placeholder="enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="updatemobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="updatemobile"
                            placeholder="enter your mobile number">
                    </div>
                    <div class="mb-3">
                        <label for="updateplace" class="form-label">Place</label>
                        <input type="text" class="form-control" id="updateplace" placeholder="enter your place">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick="updateDetails()">Update</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <input type="hidden" id="hiddendata">
                </div>
            </div>
        </div>
    </div>

    <div class="container my-3">
        <h1 class="text-center">PHP CRUD operations using Bootstrap Modal</h1>
        <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#CompleteModal">
            Add new users
        </button>
        <div id="displayDataTable">
            fff
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>

        //function for fixing fectched table
        $(document).ready(function () {
            displayData();
        })

        //display function
        function displayData() {
            var displayData = "true"
            $.ajax({
                url: "display.php",
                type: 'post',
                data: {
                    displaySend: displayData
                },
                //data display below button
                //calling table id
                success: function (data, status) {
                    $('#displayDataTable').html(data); //table in display.php display as html table
                }
            })
        }
        function adduser() {
            var nameAdd = $('#completename').val();
            var emailAdd = $('#completeemail').val();
            var mobileAdd = $('#completemobile').val();
            var placeAdd = $('#completeplace').val();

            $.ajax({
                url: "insert.php",
                type: "post",
                data: {
                    nameSend: nameAdd,
                    emailSend: emailAdd,
                    mobileSend: mobileAdd,
                    placeSend: placeAdd
                },
                success: function (data, status) {
                    // function to display data
                    $('#CompleteModal').modal('hide');
                    displayData();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error in processing request:', textStatus, errorThrown);
                    alert('Error in processing request: ' + textStatus + ' - ' + errorThrown);
                }
            });
        }

        //delete record
        function DeleteUser(deleteid) {
            $.ajax({
                url: "delete.php",
                type: 'post',
                data: {
                    deleteSend: deleteid
                },
                success: function (data, status) {
                    displayData(); //for staying in the page 
                }
            });
        }

        //Update function
        function GetDetails(updateid) {
            $('#hiddendata').val(updateid);

            //url,data,function directly given
            $.post("update.php",{updateid:updateid},function(data,status){
                //for  getting data as js object key value pair
                var userid=JSON.parse(data);
                $('#updatename').val(userid.name);
                $('#updateemail').val(userid.email);
                $('#updatemobile').val(userid.mobile);
                $('#updateplace').val(userid.place);


            });
            $('#updateModal').modal("show"); //bootstrap js for display modal

        }

        //onclick update event function
        function updateDetails(){
            //stroing values in a variable
        var updatename=$('#updatename').val();
        var updateemail=$('#updateemail').val();
        var updatemobile=$('#updatemobile').val();
        var updateplace=$('#updateplace').val();
        var hiddendata=$('#hiddendata').val();

        $.post("update.php",{
            updatename:updatename,
            updateemail:updateemail,
            updatemobile:updatemobile,
            updateplace:updateplace,
            hiddendata:hiddendata
                
        },function(data, status){
            //access modal id
            //closing modal
            $('#updateModal').modal('hide');
            displayData();
        });
        }
    </script>
</body>

</html>