<!DOCTYPE html>
<html lang="en">

<head>

    <link href="../css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Search Employee to Edit</h2>


                    <form action="edit-Employee.php"  method="POST">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Employee ID</label>
                                    <input class="input--style-4" type="number" name="emp_id">
                                </div>
                            </div>
                            <div class="p-t-15">
                                <button class="btn btn--radius-2 btn--blue" type="submit">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>