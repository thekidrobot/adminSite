function toggle(showHideDiv, switchTextDiv) {
	var ele = document.getElementById(showHideDiv);
	var text = document.getElementById(switchTextDiv);
	if(ele.style.display == "block") {
    		ele.style.display = "none";
				text.innerHTML = "Click to show";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "Click to hide";
	}
}