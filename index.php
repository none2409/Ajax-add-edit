<!doctype html>
<html lang="en">

<head>
    <title>Multiple Insert Ajax</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--  jQuery UI -->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <div class="container">
        <br />

        <h3 align="center">PHP - Sending multiple forms data through jQuery Ajax</a></h3><br />
        <br />
        <br />
        <div align="right" style="margin-bottom:5px;">
            <button type="button" name="add" id="add" class="btn btn-success btn-xs">Thêm yêu cầu</button>
        </div>
        <br />
        <form method="post" id="user_form">
            <div class="table-responsive">
            <table class="table table-striped table-bordered" id="user_data">
                     <thead>
                         <tr>
                             <th scope="col">Name</th>
                             <th scope="col">Email</th>
                             <th scope="col">Details</th>
                             <th scope="col">Remove</th>
                         </tr>
                     </thead>
                     <tbody>

                     </tbody>
                 </table>
            </div>
            <div align="center">
                <input type="submit" name="insert" id="insert" class="btn btn-primary" value="Gửi Yêu Cầu" />
            </div>
        </form>

        <br />
    </div>
    <div id="user_dialog" title="Add Data">
        <div class="form-group">
            <label>Enter First Name</label>
            <input type="text" name="full_name" id="full_name" class="form-control" />
            <span id="error_name" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label>Enter Last Name</label>
            <input type="text" name="full_email" id="full_email" class="form-control" />
            <span id="error_email" class="text-danger"></span>
        </div>
        <div class="form-group" align="center">
            <input type="hidden" name="row_id" id="hidden_row_id" />
            <button type="button" name="save" id="save" class="btn btn-info">Thêm</button>
        </div>
    </div>
    <div id="action_alert" title="Action">

    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        var count = 0;
        $('#user_dialog').dialog({
            autoOpen: false,
            width: 600,
        });
        $('#add').click(function() {
            $('#user_dialog').dialog('option', 'title', 'Thêm dữ liệu');
            $('#full_name').val(' ');
            $('#full_email').val(' ');
            $('#error_name').text(' ');
            $('#error_email').text(' ');
            $('#full_name').css('border-color', ' ');
            $('#full_email').css('border-color', ' ');
            $('#save').text('save');
            $('#user_dialog').dialog('open');
        });
        $('#save').click(function() {
            var error_name = ' ';
            var error_email = ' ';
            var full_name = ' ';
            var full_email = ' ';

            if ($('#full_name').val() == ' ') {
                error_name = 'Bạn chưa nhập tên';
                $('#error_name').text(error_name);
                $('#full_name').css('border-color', '#cc0000');
                full_name = ' ';
            } else {
                error_name = ' ';
                $('#error_name').text(error_name);
                $('#full_name').css('border-color', ' ');
                full_name = $('#full_name').val();
            };
            if ($('#full_email').val() == ' ') {
                error_email = 'Bạn chưa nhập email';
                $('#error_email').text(error_email);
                $('#full_email').css('border-color', '#cc0000');
                full_email = ' ';
            } else {
                error_email = ' ';
                $('#error_email').text(error_email);
                $('#full_email').css('border-color', ' ');
                full_email = $('#full_email').val();
            };
            if (error_name != ' ' || error_email != ' ') {
                return false;
            } else {
                if ($('#save').text() == 'save') {
                    count = count + 1;
                    output = '<tr id = "row_' + count + '">';
                    output += ' <td>' + full_name + ' <input type="hidden" name="hidden_full_name[]" id="full_name' + count + '" class = "full_name" value="' + full_name + '"/></td> ';
                    output += ' <td>' + full_email + ' <input type="hidden" name="hidden_full_email[]" id="full_email' + count + '"value="' + full_email + '"/></td> ';
                    output += ' <td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="' + count + '">Sửa</button></td>';
                    output += ' <td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="' + count + '">Xóa</button></td>';
                    output += '</tr>';
                    $('#user_data').append(output);
                } else {
                    // edit content

                    var row_id = $('#hidden_row_id').val();
                    output = '<td>' + full_name + ' <input type="hidden" name="hidden_full_name[]" id="full_name' + row_id + '" class="full_name" value="' + full_name + '" /></td>';
                    output += ' <td>' + full_email + ' <input type="hidden" name="hidden_full_email[]" id="full_email' + row_id + '"value="' + full_email + '"/></td> ';
                    output += ' <td><button type="button" name="view_details" class="btn btn-warning btn-xs  view_details" id="' + row_id + '">Sửa</button></td>';
                    output += ' <td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="' + row_id + '">Xóa</button></td>';
                    $('#row_' + row_id + ' ').html(output);

                }
                $('#user_dialog').dialog('close');
            }
        });
        //Button Edit
        $(document).on('click', '.view_details', function() {
            var row_id = $(this).attr("id");
            var full_name = $('#full_name' + row_id + '').val();
            var full_email = $('#full_email' + row_id + '').val();
            $('#full_name').val(full_name);
            $('#full_email').val(full_email);
            $('#save').text('Edit');
            $('#hidden_row_id').val(row_id);
            $('#user_dialog').dialog('option', 'title', 'Sửa dữ liệu');
            $('#user_dialog').dialog('open');
        });


        //Button Remove

        $(document).on('click', '.remove_details', function() {
            var row_id = $(this).attr("id");
            if (confirm('Bạn chắc chắn muốn xóa dữ liệu')) {
                $('#row_' + row_id + ' ').remove();
            } else {
                return false;
            }
        });

        $('#action_alert').dialog({
            autoOpen: false
        });
        $('#user_form').on('submit', function(event) {
            event.preventDefault();
            var count_data = 0;
            $('.full_name').each(function() {
                count_data = count_data + 1;
            });
            if (count_data > 0) {
                var form_data = $(this).serialize(); //Chuyeenr thanh string
                $.ajax({
                    url: "./insert.php",
                    method: "post",
                    data: form_data,
                    success: function(data) {
                        $('#user_data').find("tr:gt(0)").remove();
                        $('#action_alert').html('<p>Dữ liệu đã được thêm thành công</p>');
                        $('#action_alert').dialog('open');
                    }

                });

            } else {
                $('#action_alert').html('<p>Bạn phải thêm ít nhất 1 dữ liệu</p>');
                $('#action_alert').dialog('open');
            }
        });


    });
</script>