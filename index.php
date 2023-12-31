<!doctype html>
<html>
<head>
    <title>Make Autocomplete Search with jQuery AJAX</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="jquery-3.3.1.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            $("#txt_search").keyup(function(){
                var search = $(this).val();

                if(search != ""){

                    $.ajax({
                        url: 'getSearch.php',
                        type: 'post',
                        data: {search:search, type:1},
                        dataType: 'json',
                        success:function(response){

                            var len = response.length;
                            $("#searchResult").empty();
                            for( var i = 0; i<len; i++){
                                var id = response[i]['id'];
                                var name = response[i]['name'];

                                $("#searchResult").append("<li value='"+id+"'>"+name+"</li>");

                            }

                            // binding click event to li
                            $("#searchResult li").bind("click",function(){
                                setText(this);
                            });


                        }
                    });
                }

            });


        });


        function setText(element){

            var value = $(element).text();
            var userid = $(element).val();

            $("#txt_search").val(value);
            $("#searchResult").empty();

            // Request User Details
            $.ajax({
                url: 'getSearch.php',
                type: 'post',
                data: {userid:userid, type:2},
                dataType: 'json',
                success: function(response){

                    var len = response.length;
                    $("#userDetail").empty();
                    if(len > 0){
                        var username = response[0]['username'];
                        var email = response[0]['email'];
                        $("#userDetail").append("Username : " + username + "<br/>");
                        $("#userDetail").append("Email : " + email);
                    }
                }

            });
        }

    </script>
</head>
<body>
    
    <div>Enter Name </div>
    <div>
        <input type="text" id="txt_search" name="txt_search">
    </div>
    <ul id="searchResult"></ul>

    <div class="clear"></div>
    <div id="userDetail"></div>

</body>
</html>

