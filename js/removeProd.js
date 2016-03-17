/**
 * Created by umairghazi on 3/16/16.
 */



$(document).ready(function () {

    $("a.deleteProduct").click(function (event) {

        if (confirm("Are you Sure!")) {
            var p_id = parseInt(event.target.getAttribute('data-pid'));
            var u_id = parseInt(event.target.getAttribute('data-uid'));//Sending user id on  server for authentication.

            $.ajax({
                type: "GET",
                url: "php/deleteProdService.php",
                data: {
                    products_id: p_id
                },
                success: function (result) {
                    console.log("Result::" + result);

                    if (result > 0) {
                        $("#cart_item" + p_id).remove();
                    }
                    else if (parseInt(result) == -2) {
                        alert("The Product you are trying to delete is on sale and Sale Items Can't be less than 3!");
                    }
                    else {
                        console.log("Server Error");
                    }

                }
            });
            console.log(p_id + "::" + u_id);
        }
        else {
            console.log("Wise Choice!");
        }
        event.preventDefault();
        return false;

    })


});





