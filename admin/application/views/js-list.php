<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="cleartype" content="on">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <title></title>

    <link href="<?php echo base_url().get_path('js'); ?>plugins/listselect/listselect.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url().get_path('common-js'); ?>jquery-2.1.3.min.js"></script>
    <script src="<?php echo base_url().get_path('js'); ?>plugins/listselect/listselect.js" type="text/javascript"></script>

    <script>

        $(document).ready(function () {

            var data = [
                {id: "1", text: "AA", level:"1", parent: "0"},
                {id: "2", text: "BB", level:"1", parent: "0"},
                {id: "3", text: "CC", level:"1", parent: "0"},

                {id: "4", text: "DD", level:"2", parent: "0"},
                {id: "5", text: "EE", level:"2", parent: "0"},

                {id: "6", text: "FF", level:"3", parent: "0"}
            ];


            $("#aa").listselect({data:data});

        });

    </script>


</head>
<body>

<input id="aa" name="aa" type="text">


</body>
</html>