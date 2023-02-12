window.onload = function() {
    request([{ type: "list" }], setNamesList);
    $("search").onclick = getName;
    $("loadingnames").hide();
};

function request(para, func) {
    new Ajax.Request(
        "../../../~tzt0062/babynames/babynames.php",
        {
            method: "get",
            parameters : para[0],
            onSuccess : func,
            onFailure : failedAjax,
            onException : failedAjax,
        }
    );
}

function setNamesList(ajax) {
  let names = ajax.responseText.split("\n");
  names.sort();
  for (var i = 0; i < names.length; i++) {
    addOption("allnames", names[i]);
  }
  $("allnames").removeAttribute("disabled");
}

function addOption(id, name) {
    var option = document.createElement("option");
    var text = document.createTextNode(name);
    option.appendChild(text);
    option.setAttribute('value', name);
    $(id).appendChild(option);
}

function getName() {
    var name = $("allnames").value;
    var gender = getGender();

    if (name != "") {
        resetResults();
        request([{type: "meaning", name: name }], getMeaning); 
        request([{type: "rank", name: name, gender: gender}], getRank);
        request([{type: "celebs", name: name, gender: gender}], getCelebrities);
    }
}

function getMeaning(ajax) {
    $("meaning").innerHTML = ajax.responseText;
    $("loadingmeaning").hide();
}

function getRank(ajax) {
    var ranks = ajax.responseXML.getElementsByTagName("rank");
    var tr1 = document.createElement("tr");
    for (var i = 0; i < ranks.length; i++) {
        var th = document.createElement("th");
        var value = document.createTextNode(ranks[i].getAttribute("year"));
        th.appendChild(value);
        tr1.appendChild(th);
    }

    var tr2 = document.createElement("tr");
    for (var i = 0; i < ranks.length; i++) {
        var td = document.createElement("td");
        var div = document.createElement("div");
        var value = ranks[i].firstChild.nodeValue;
        if (value > 0 && value <= 10) {
            div.setAttribute("class", "rankBar top10Rank");
        } else {
            div.setAttribute("class", "rankBar");
        }
        div.setAttribute("style", "height:" + calculateHeight(value) + "px;");
        div.appendChild(document.createTextNode(value));
        td.appendChild(div);
        tr2.appendChild(td);
    }
    $("graph").appendChild(tr1);
    $("graph").appendChild(tr2);
    $("loadinggraph").hide();
}

function getCelebrities(ajax) {
    let celebs = JSON.parse(ajax.responseText);
    for(var i = 0; i < celebs.actors.length; i++) {
        var li = document.createElement("li");
        li.innerHTML = celebs.actors[i].firstName + " " 
        + celebs.actors[i].lastName + " (" + celebs.actors[i].filmCount + " films)";
        $("celebs").appendChild(li);
    }
    $("loadingnames").hide();
    $("loadingcelebs").hide();
}

function getGender() {
    var genders = document.getElementsByName("gender");
    for (var i = 0; i < genders.length; i++) {
        if (genders[i].checked) {
            return genders[i].value;
        }
    }
}

function hideLoadings() {
    $("loadingnames").hide();
    $("loadingmeaning").hide();
    $("loadinggraph").hide();
    $("loadingcelebs").hide();
}

function resetLoadings() {
    $("loadingnames").show();
    $("loadingmeaning").show();
    $("loadinggraph").show();
    $("loadingcelebs").show();
}

function resetResults() {
    resetLoadings();
    $("resultsarea").show();
    $("meaning").innerHTML = "";
    $("graph").innerHTML = "";
    $("norankdata").hide();
    $("celebs").innerHTML = "";
    $("errors").innerHTML = "";
}

function calculateHeight(ranking) {
    var height = 0; 
    if (ranking != 0) {
        height = parseInt((1000 - ranking) / 4);
    }
    return height;
}

function failedAjax(ajax, exception) {
    hideLoadings();
    var message = "";
    if(exception) {
        message += " Exception: " + exception.message;
    } else {
        if (ajax.status == 410) {
            $("norankdata").show();
            $("loadinggraph").hide();
        } else {
            message += "Server status: " + ajax.status + " Status text: " + ajax.statusText +
			" Server response text: " + ajax.responseText;
        }
	}
    $("errors").innerHTML = message;
}

