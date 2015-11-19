/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function show(id)
{
    $.post('http://localhost/ci/student/popup/', {send: id}, function(result) {
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
        var len = data.length;
        if (data[7] != null)
            document.getElementById("getremark").innerHTML = "<tr> <td><b>" + data[7] + "</b> ( " + data[8] + " )</td> <td>" + data[9] + "</td> </tr>";
        else
            document.getElementById("getremark").innerHTML = "<tr><td>No remarks added yet...</td></tr>";
        for (i = 10; i < len; i += 3)
            document.getElementById("getremark").innerHTML += "<tr> <td><b>" + data[i] + "</b> ( " + data[i + 1] + " )</td> <td>" + data[i + 2] + "</td> </tr>";
    });
}

