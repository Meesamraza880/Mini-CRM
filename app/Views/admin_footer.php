 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
 <script>
        $(document).ready(function() {
            show_users();
            $('#myTable').DataTable();
        });

        $("#signupform").submit(function(evt) {
            var obj = document.getElementById("signupform");
            evt.preventDefault();
            var formData = new FormData(obj);
            formData.append("image", $("#formFile")[0].files[0]);

            $.ajax({
                url: "register",
                method: "POST",
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: "multipart/form-data",
                processData: false,
                success: function(response) {
                    alert(response);
                },
            });

            return false;
        });

        $("#add_rec").submit(function(evt) {
            var obj = document.getElementById("add_rec");
            evt.preventDefault();
            var formData = new FormData(obj);
            formData.append("image", $("#formFile")[0].files[0]);

            $.ajax({
                url: "add_rec",
                method: "POST",
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: "multipart/form-data",
                processData: false,
                success: function(response) {
                    $("#add_rec").trigger('reset');
                    alert(response);
                },
            });

            return false;
        });

        function show_users() {
            var id = $('#user_id').val()
            $.ajax({
                url: "show_user",
                method: "POST",
                data: {
                    'user_id': id
                },
                success: function(response) {

                    // console.log(response.recruites);
                    $.each(response.recruites, function(key, value) {
                        if (value['status'] == 1) {


                            $('#show_user_list').append('<tr>\
                        <td>' + value['first_name'] + '</td>\
                        <td>' + value['last_name'] + '</td>\
                        <td>' + value['email'] + '</td>\
                        <td>' + value['password'] + '</td>\
                        <td>' + value['landline'] + '</td>\
                        <td><a href="Edit/' + value['id'] + '">Edit</a></td>\
                        <td><a href="Delete/' + value['id'] + '">Delete</a></td>\
                         </tr >');
                        }
                    })


                },
            });
        }

        function edit_user(id) {

            $.ajax({
                url: "edit",
                method: "POST",
                data: {
                    'user_id': id
                },
                success: function(response) {
                    alert(response);
                },
            });
        };



        // setInterval(function() {

        // }, 1000);




        // $("#loginform").submit(function(evt) {
        //     var obj = document.getElementById("loginform");
        //     evt.preventDefault();
        //     var formData = new FormData(obj);
        //     // formData.append("image", $("#formFile")[0].files[0]);

        //     $.ajax({
        //         url: "login",
        //         method: "POST",
        //         data: formData,
        //         async: false,
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         success: function(response) {
        //             alert(response);
        //         },
        //     });

        //     return false;
        // });
    </script>


    </body>

    </html>