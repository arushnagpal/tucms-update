// JavaScript Document
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
		document.getElementById("count").innerHTML = "(Maximum characters: 60) You have "+limitCount.value+" characters left.";
	}
}

function changeRC() {
	var type = document.activeElement.value;
	document.getElementById("complaint").reset();
	document.getElementById("type").innerHTML = "<h3>" + type + "</h3>" + "<input type=\"hidden\" name=\"type\" value=" + type + ">";
	document.getElementById("room_cluster").style.display = "block";	
}
function changeCluster() {
	var type = document.activeElement.value;
	document.getElementById("complaint").reset();
	document.getElementById("type").innerHTML = "<h3>" + type + "</h3>" + "<input type=\"hidden\" name=\"type\" value='" + type + "'>";
	document.getElementById("room_cluster").style.display = "none";	
}