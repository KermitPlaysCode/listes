function update_div(div_name, data) {
    document.getElementById(div_name).innerHTML = data;
    return 0;
}

function load_data(div_name) {
    let xmlHttpReq = new XMLHttpRequest();
    theUrl = "make-data.php?div="+div_name;
    xmlHttpReq.addEventListener("load", function() { update_div(div_name, xmlHttpReq.responseText); }, false);
    xmlHttpReq.open("GET", theUrl, false);
    xmlHttpReq.send(null);
    return 0;
}

const action_to_script = {
    'allow_one': 'update_acces.php',
    'deny_one': 'update_acces.php',
    'allow_all': 'update_acces.php',
    'deny_all': 'update_acces.php',
}

const script_to_items = {
    'update_acces.php': ['c_list_name', 'c_user_name'],
    'update_admin.php': ['a_user_name', 'a_user_pass']
}


function get_data(action_name) {
    // Gather values and prepare URL
    script_name = action_to_script[action_name];
    theUrl = script_name + "?act=" + encodeURIComponent(action_name);
    elem_id = script_to_items[script_name];
    for (id of elem_id) {
        theUrl = theUrl + '&' + id + '=' + encodeURIComponent(document.getElementById(id).value);
    }
    // Make the call
    let xmlHttpReq = new XMLHttpRequest();
    xmlHttpReq.addEventListener("load", function() { update_div('console', xmlHttpReq.responseText); }, false);
    xmlHttpReq.open("GET", theUrl, false);
    xmlHttpReq.send(null);
    return 0;
}

// Request action 'act'
// Build parameters from text fields u and p (username and password)
function get_admin(act) {
    let xmlHttpReq = new XMLHttpRequest();
    var user = document.getElementById('admin_u').value;
    var pass = document.getElementById('admin_p').value;
    var theUrl = "update_admin.php?u="+user+"&p="+pass+"&act="+act;
    xmlHttpReq.addEventListener("load", function() { update_div('console', xmlHttpReq.responseText); }, false);
    xmlHttpReq.open("GET", theUrl, false);
    xmlHttpReq.send(null);
    return 0;
}

// Request action 'act'
// Build parameters from text fields u and p (username and password)
function get_acces(act) {
    let xmlHttpReq = new XMLHttpRequest();
    var list = document.getElementById('quelle_liste').value;
    var user = document.getElementById('quel_user').value;
    var theUrl = "update_acces.php?u="+user+"&l="+list+"&act="+act;
    xmlHttpReq.addEventListener("load", function() { update_div('console', xmlHttpReq.responseText); }, false);
    xmlHttpReq.open("GET", theUrl, false);
    xmlHttpReq.send(null);
    return 0;
}

// Request action 'act' on item 'i'
function get_liste(i, act) {
    let xmlHttpReq = new XMLHttpRequest();
    var item = document.getElementById(i).value;
    var act = document.getElementById(action).value;
    var theUrl = "update_liste.php?i="+item+"&act="+act;
    xmlHttpReq.addEventListener("load", function() { update_div('console', xmlHttpReq.responseText); }, false);
    xmlHttpReq.open("GET", theUrl, false);
    xmlHttpReq.send(null);
    return 0;
}
