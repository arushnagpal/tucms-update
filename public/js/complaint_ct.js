// JavaScript Document
function show(id)
{
    $.post('http://localhost/ci/index.php/admin/popup/', {send: id}, function(result) {
        var data = result.split(",");
        document.getElementById("ajaxdata").innerHTML = "<td>" + data[0] + "</td>";
        for (i = 1; i < 7; i++)
        {
            if (i == 5)
            {
                if (data[i] == 'Pending')
                    document.getElementById("ajaxdata").innerHTML += "<td><b style='color:blue'>" + data[i] + "</b></td>";
                else if (data[i] == 'Complete')
                    document.getElementById("ajaxdata").innerHTML += "<td><b style='color:green' >" + data[i] + "</b></td>";
                else if (data[i] == 'Urgent')
                    document.getElementById("ajaxdata").innerHTML += "<td><b style='color:red'>" + data[i] + "</b></td>";
                else
                    document.getElementById("ajaxdata").innerHTML += "<td>" + data[i] + "</td>";
            }
            else
                document.getElementById("ajaxdata").innerHTML += "<td>" + data[i] + "</td>";
        }
        //var date = data[7];
        //document.getElementById("complete").innerHTML = date;
        var len = data.length;
        if (data[7] != null)
            document.getElementById("getremark").innerHTML = "<tr> <td><b>" + data[7] + "</b> ( " + data[8] + " )</td> <td>" + data[9] + "</td> </tr>";
        else
            document.getElementById("getremark").innerHTML = "<tr><td>No remarks added yet...</td></tr>";
        for (i = 10; i < len; i += 3)
            document.getElementById("getremark").innerHTML += "<tr> <td><b>" + data[i] + "</b> ( " + data[i + 1] + " )</td> <td>" + data[i + 2] + "</td> </tr>";
    });
}

function update() {
    var re = document.getElementById("remark").value;
    var expdate = document.getElementById("complete").value;
    var stat = document.getElementById("status").selectedIndex;
    var stats = document.getElementById("status")[stat].value;
    //window.alert(re+expdate+stats);
    $.post('http://localhost/ci/index.php/admin/updateRemark/', {remark: re, status: stats, cdate: expdate}, function(result) {
        window.location.assign("http://localhost/ci/index.php/admin/");

    });
}