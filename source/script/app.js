// Modifier le formulaire d'ajout pour qu'il puisse modifier les évenements 

var clicked = false;
function editEvent(idEvent) {
    var eventCase = document.getElementById(idEvent);
    if (!clicked) {
        var eventTitle = eventCase.querySelector(".intitule").innerHTML;
        var eventDate = eventCase.querySelector('.date').innerHTML;
        var eventHour = eventCase.querySelector('.heure').innerHTML;
        var eventDesc = eventCase.querySelector('.description').innerHTML;
        
        document.getElementById("id_event").value = idEvent;
        document.querySelector("#title").value = eventTitle;
        document.querySelector("#date").value = parseDate(eventDate);
        document.querySelector("#time").value = eventHour;
        document.querySelector("#description").value = eventDesc;
    
        document.querySelector("#form_title").innerHTML = "Modifier l'événement";
        document.querySelector("#submit_event").value = "Modifier";
        document.getElementById("add_event_form").action = "edit_event.php";
    
        eventCase.style.border = "solid black 3px";
        clicked = true;
    } else {
        resetForm();
        document.getElementById("date").value = "";
        eventCase.style.border = "solid black 0px";
        clicked = false;
    }
}

var cancelButton =  document.getElementById("#cancel_button");
cancelButton.onclick = resetForm();
function resetForm() {
    var idEvent = document.getElementById("id_event").value;
    document.getElementById(idEvent).style.border = "solid black 0px";
    clicked = false;

    var submitButton = document.getElementById("submit_event");
    submitButton.value = "Ajouter";
    document.querySelector("#form_title").innerHTML = "Ajouter un événement";

    document.getElementById("title").value = "";
    document.getElementById("date").value = "";
    document.getElementById("time").value = "12:00";
    document.getElementById("description").value = "";
    document.getElementById("id_event").value = "";
    document.getElementById("add_event_form").action = "add_event.php";
}

function parseDate(date) {
    var dateParsed = date.split("/");
    var day = dateParsed[0];
    var month = dateParsed[1];
    var year = dateParsed[2];
    return year+"-"+month+"-"+day;
}